<?php
namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Log the incoming webhook payload
        $payload = $request->all();
        Log::info('Square Webhook Received:', $payload);

        // Verify webhook signature (optional for production)
        $signature = $request->header('X-Square-Signature');
        if (!$this->verifySignature($request->getContent(), $signature)) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Process the webhook event
        $eventType = $payload['type'];
        $data = $payload['data']['object'];

        if ($eventType === 'payment.updated') {
            $this->handlePaymentUpdate($data);
        } elseif ($eventType === 'order.updated') {
            $this->handleOrderUpdate($data);
        }

        return response()->json(['success' => true]);
    }

    private function handlePaymentUpdate($payment)
    {
        $paymentStatus = $payment['status'];
        $orderId = $payment['order_id'];

        if ($paymentStatus === 'COMPLETED') {
            // Update database with payment details
            Log::info('Payment completed for order: ' . $orderId);
        } elseif ($paymentStatus === 'FAILED') {
            // Handle failed payment
            Log::warning('Payment failed for order: ' . $orderId);
        }
    }

    private function handleOrderUpdate($order)
    {
        $orderState = $order['state'];
        $orderId = $order['id'];

        Log::info('Order updated: ' . $orderId . ' with state: ' . $orderState);
    }

    private function verifySignature($payload, $signature)
    {
        $webhookSignatureKey = config('services.square.webhook_signature_key');
        $calculatedSignature = base64_encode(hash_hmac('sha1', $payload, $webhookSignatureKey, true));
        return hash_equals($calculatedSignature, $signature);
    }
}
