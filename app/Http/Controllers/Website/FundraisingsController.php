<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserBusinessInfos;
use App\Models\Fundraising;
use App\Models\user;
use App\Models\Ngo;
use App\Models\Donation;
use App\Models\FundraisingImage;
use App\Models\FundraisingCategory;
use App\Models\JobCategory;
use App\Models\Skill;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Square\SquareClient;
use Square\Models\Money;
use Illuminate\Support\Facades\Mail;
use Square\Models\CreatePaymentRequest;
use Square\Exceptions\ApiException;

class FundraisingsController extends Controller
{
    protected function commbankBasePayload(): array
    {
        $merchantId = config('services.commbank.merchant_id');
        return [
            'merchant'    => $merchantId,
            'apiUsername' => 'merchant.' . $merchantId,
            'apiPassword' => config('services.commbank.api_password'),
        ];
    }
    

    public function index()
    {
        // Retrieve all fundraising entries with related images, categories, and NGOs
        $fundraisings = Fundraising::with(['fundraisingImages', 'category', 'user', 'ngo'])
            ->where('status', 1)
            ->get();
    
        $featuredfundraisings = Fundraising::with(['fundraisingImages', 'category', 'ngo'])
            ->where(['status' => 1, 'featured' => 1])
            ->get();
    
        // Fetch all active categories and count the active fundraisings in each category
        $categories = FundraisingCategory::where('status', 1)
            ->withCount(['fundraisings as fundraisings_infos_count'])
            ->get();
    
        return view('website.fundraisings.index', compact('fundraisings', 'featuredfundraisings', 'categories'));
    }

    
    public function fundaraising_details($slug, Request $request)
    {
        $fundraiser = Fundraising::where('slug', $slug)
            ->with([
                'fundraisingImages',
                'category',
                'user',
                'ngo' => function($query) {
                    $query->select('id','ngo_name','establishment','logo_path','contact_email','ngo_city','ngo_state');
                }
            ])
            ->firstOrFail();

        $encryptedNgoId = $fundraiser->ngo ? Crypt::encrypt($fundraiser->ngo->id) : null;

        $goalAmount  = $fundraiser->amount;
        $totalRaised = Donation::where('fundraising_id', $fundraiser->id)->sum('amount');
        $memberCount = $fundraiser->ngo ? $fundraiser->ngo->members()->count() : 0;
        $ngoInfo     = $fundraiser->ngo;

        $topDonors = Donation::where('fundraising_id', $fundraiser->id)
            ->select(
                'user_id',
                'created_at',
                \DB::raw('SUM(amount) as total_amount'),
                \DB::raw('MAX(anonymous) as is_anonymous'),
                \DB::raw('MAX(donation_number) as latest_donation_number'),
                \DB::raw('MAX(created_at) as last_donation_time')
            )
            ->groupBy('user_id')
            ->orderByDesc('total_amount')
            ->with('user')
            ->take(5)
            ->get();

        $allDonors = Donation::where('fundraising_id', $fundraiser->id)
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(10);

        $liveDonations = Donation::where('fundraising_id', $fundraiser->id)
            ->where('created_at', '>=', now()->subDay())
            ->orderByDesc('created_at')
            ->with('user')
            ->get();

        // If AJAX request -> return donors only
        if ($request->ajax()) {
            $html = '';
            foreach ($allDonors as $donor) {
                $html .= '
                    <div class="alldonor-item">
                        <div class="alldonor-left">
                            <img src="https://eversabz.com/assets/images/avatar/eversabz-charity.png" class="alldonor-avatar">
                            <div>
                                <div class="alldonor-date">'. $donor->created_at->format('D, j M Y') .'</div>
                                <div class="alldonor-name">'. ($donor->anonymous ? 'Anonymous' : ($donor->user->name ?? 'Unknown')) .'</div>
                                '. (!empty($donor->message) ? '<div class="alldonor-message">'. e($donor->message) .'</div>' : '') .'
                            </div>
                        </div>
                        <div class="alldonor-amount">$'. number_format($donor->amount, 2) .'</div>
                    </div>
                ';
            }

            return response()->json([
                'html'    => $html,
                'hasMore' => $allDonors->hasMorePages(),
                'nextPage'=> $allDonors->currentPage() + 1
            ]);
        }

        return view('website.fundraisings.show', compact(
            'encryptedNgoId','fundraiser','goalAmount',
            'totalRaised','topDonors','liveDonations',
            'ngoInfo','memberCount','allDonors'
        ));
    }

    public function loadMore(Request $request, $fundraiserId)
    {
        $page = $request->get('page', 1);

        $donors = Donation::where('fundraising_id', $fundraiserId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(10, ['*'], 'page', $page);

        return view('donors.partials.donor_list', compact('donors'))->render();
    }

    public function support($slug)
    {
        $fundraising = Fundraising::with(['fundraisingImages', 'category', 'user', 'ngo'])
            ->where('slug', $slug)
            ->firstOrFail(); 

        $ngoInfo = $fundraising->ngo;
        $encryptedNgoId = Crypt::encrypt($ngoInfo->id);
        $memberCount = 10;
        $encryptedId = Crypt::encrypt($fundraising->id);
        
        $categories = FundraisingCategory::where('status', 1)
            ->withCount(['fundraisings as fundraisings_infos_count'])
            ->get();

        return view('website.fundraisings.donate', compact('fundraising', 'categories', 'ngoInfo', 'memberCount','encryptedId','encryptedNgoId'));
    }


    public function apply($slug){
        
        $fundraising = Fundraising::with(['fundraisingImages', 'category', 'user', 'ngo'])
            ->where('slug', $slug)
            ->firstOrFail(); 

        $id = $fundraising?->user_id;
         $user = User::with([
            'candidateProfile',
            'candidateProfile.skills',
            'candidateProfile.categories',
            'candidateLanguages',
            'educations',
            'experiences'
        ])->findOrFail($id);

        $jobCategories = JobCategory::where('status', 'active')->get();
        $allSkills = Skill::where('status', 1)->get();

        return view('website.fundraisings.applynowform',compact('fundraising','user','jobCategories','allSkills'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'You need to be logged in to make a donation.'
            ], 401); 
        }

        $rules = [
            'nonce' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'tipPercentage' => 'required|numeric|min:0',
            'coverTransactionCosts' => 'required|in:0,1',
            'anonymous' => 'nullable|in:0,1',
            'first_name' => 'required|string|max:255',

            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:100',
            'message' => 'nullable|string|max:1000',
            'fundraising_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed. Please check the highlighted fields.',
            ], 422);
        }

        $fundraisingId = Crypt::decrypt($request->input('fundraising_id'));
        $validatedData = $validator->validated();

        $anonymous = isset($validatedData['anonymous']) && $validatedData['anonymous'] == 1 ? 1 : 0;

        $donationAmount = $validatedData['amount'];
        $tipAmount = $donationAmount * ($validatedData['tipPercentage'] / 100);
        $transactionFee = $donationAmount * 0.029 + 0.30; 
        $totalAmount = $donationAmount + $tipAmount;

        if ($validatedData['coverTransactionCosts']) {
            $totalAmount += $transactionFee;
        }

        try {
            DB::beginTransaction();

            $donationNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            $donation = \App\Models\Donation::create([
                'user_id' => $userId,
                'fundraising_id' => $fundraisingId,
                'name' => $validatedData['first_name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'country' => $validatedData['country'],
                'message' => $validatedData['message'] ?? null,
                'amount' => $donationAmount,
                'tip' => $tipAmount,
                'transaction_fee' => $transactionFee,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'anonymous' => $anonymous,
                'donation_number' => $donationNumber,
            ]);

            $paymentResponse = $this->createPayment($validatedData['nonce'], $totalAmount, $donation->id);

            if ($paymentResponse['success']) {
                try {
                    $donation->update([
                        'status' => 'successful', 
                        'payment_id' => $paymentResponse['payment_id'], 
                    ]);

                    // Store session variables
                    session()->put('donation_number', $donation->donation_number);
                    session()->put('donation_amount', $donation->amount);
                    session()->put('tip_amount', $donation->tip);
                    session()->put('transaction_fee', $donation->transaction_fee);
                    session()->put('total_amount', $donation->total_amount);

                    DB::commit();

                    $userEmail = Auth::check() ? Auth::user()->email : null;
                    if ($userEmail && filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                        Mail::to($userEmail)->send(new \App\Mail\DonationMail($donation));
                    } else {
                        Log::warning('User email is invalid or missing', ['user_id' => Auth::id(), 'email' => $userEmail]);
                    }

                    $adminEmail = config('constants.ADMIN_EMAIL');
                    if ($adminEmail && filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
                        Mail::to($adminEmail)->send(new \App\Mail\AdminDonationNotificationMail($donation));
                    } else {
                        Log::error('Admin email is invalid or missing', ['admin_email' => $adminEmail]);
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Donation successful!',
                        'redirect_url' => route('donations.success'), 
                    ]);
                } catch (\Exception $e) {
                    DB::rollBack(); 

                    return response()->json([
                        'success' => false,
                        'message' => 'An error occurred while updating donation status.' . $e->getMessage(),
                    ], 500);
                }
            } else {
                DB::rollBack(); 
                Mail::to($validatedData['email'])->send(new \App\Mail\DonationFailureMail($donation));

                return response()->json([
                    'success' => false,
                    'message' => 'Donation failed. Please try again.',
                ], 500);
            }

        } catch (\Exception $e) {
            DB::rollBack(); 
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the donation: ' . $e->getMessage(),
            ], 500);
        }
    }


    private function createPayment($nonce, $totalAmount, $donationId)
    {
        try {
            $square = new \Square\SquareClient([
                'accessToken' => config('services.square.access_token'),
                'environment' => config('services.square.environment'),
            ]);

            $paymentsApi = $square->getPaymentsApi();

            $amountInCents = (int) round($totalAmount * 100);
            Log::info('Converted amount to cents', ['total_amount' => $totalAmount, 'amount_in_cents' => $amountInCents]);

            $money = new \Square\Models\Money();
            $money->setAmount($amountInCents);
            $money->setCurrency('AUD');
            Log::info('Money object created', ['amount' => $money->getAmount(), 'currency' => $money->getCurrency()]);

            $paymentRequest = new \Square\Models\CreatePaymentRequest(
                $nonce,
                uniqid()
            );
            
            $paymentRequest->setAmountMoney($money);

            Log::info('Payment request prepared', ['request' => json_encode($paymentRequest->jsonSerialize())]);

            $paymentResponse = $paymentsApi->createPayment($paymentRequest);

            if ($paymentResponse->isSuccess()) {
                return [
                    'success' => true,
                    'payment_id' => $paymentResponse->getResult()->getPayment()->getId(),
                ];
            } else {
                Log::error('Payment failed', ['errors' => $paymentResponse->getErrors()]);
                return [
                    'success' => false,
                    'message' => $paymentResponse->getErrors(),
                ];
            }
        } catch (Exception $e) {
            Log::error('Error processing payment with Square', ['error_message' => $e->getMessage(), 'stack_trace' => $e->getTraceAsString()]);
            return [
                'success' => false,
                'message' => 'Payment processing error. Please try again.',
            ];
        }
    }


    /*
    // commweb
    protected function commbankEndpoint(): string
    {
        return rtrim(config('services.commbank.api_url'), '/');
    }

    public function createSession(Request $request): JsonResponse
    {
        try {
            $payload = array_merge($this->commbankBasePayload(), [
                'apiOperation' => 'CREATE_SESSION',
            ]);

            $resp = Http::asForm()
                ->timeout(20)
                ->post($this->commbankEndpoint(), $payload)
                ->throw(); 

            parse_str($resp->body(), $out);

            Log::debug('COMMBANK_CREATE_SESSION', ['raw' => $resp->body(), 'parsed' => $out]);

            if (($out['result'] ?? '') === 'SUCCESS' && !empty($out['session_id'])) {
                return response()->json([
                    'success'    => true,
                    'session_id' => $out['session_id'],
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $out['error_explanation'] ?? 'Failed to create payment session',
                'raw'     => $out,
            ], 500);
        } catch (\Throwable $e) {
            Log::error('COMMBANK_CREATE_SESSION_ERROR', ['ex' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment session',
            ], 500);
        }
    }

    public function updateSession(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            $payload = array_merge($this->commbankBasePayload(), [
                'apiOperation'   => 'UPDATE_SESSION',
                'session.id'     => $request->session_id, 
                'order.amount'   => number_format((float)$request->amount, 2, '.', ''),
                'order.currency' => 'AUD',
                'order.id'    => 'sess_' . $request->session_id,
            ]);

            $resp = Http::asForm()
                ->timeout(20)
                ->post($this->commbankEndpoint(), $payload)
                ->throw();

            parse_str($resp->body(), $out);

            Log::debug('COMMBANK_UPDATE_SESSION', ['raw' => $resp->body(), 'parsed' => $out]);

            if (($out['result'] ?? '') === 'SUCCESS') {
                return response()->json(['success' => true]);
            }

            return response()->json([
                'success' => false,
                'message' => $out['error_explanation'] ?? 'Failed to update payment session',
                'raw'     => $out,
            ], 500);
        } catch (\Throwable $e) {
            Log::error('COMMBANK_UPDATE_SESSION_ERROR', ['ex' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Error updating payment session',
            ], 500);
        }
    }

    
    // based on commweb
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'tip' => 'required|numeric|min:0',
            'transaction_fee' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:1',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:100',
            'message' => 'nullable|string|max:1000',
            'session_id' => 'required|string', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            do {
                $donationNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (\App\Models\Donation::where('donation_number', $donationNumber)->exists());

            $payload = array_merge($this->commbankBasePayload(), [
                'apiOperation'           => 'PAY',
                'order.id'               => $donationNumber,
                'order.amount'           => number_format((float)$request->total_amount, 2, '.', ''),
                'order.currency'         => 'AUD',
                'session.id'             => $request->session_id,
                'sourceOfFunds.type'     => 'CARD',
                'order.reference'      => 'Donation ' . $donationNumber,
            ]);

            $resp = Http::asForm()
                ->timeout(30)
                ->post($this->commbankEndpoint(), $payload)
                ->throw();

            parse_str($resp->body(), $out);

            Log::debug('COMMBANK_PAY', ['raw' => $resp->body(), 'parsed' => $out]);

            $resultOk  = ($out['result'] ?? '') === 'SUCCESS';
            $approved  = ($out['response_gatewayCode'] ?? '') === 'APPROVED';

            if ($resultOk && $approved) {
                $donation = \App\Models\Donation::create([
                    'donation_number'  => $donationNumber,
                    'amount'           => (float)$request->amount,
                    'tip'              => (float)$request->tip,
                    'transaction_fee'  => (float)$request->transaction_fee,
                    'total_amount'     => (float)$request->total_amount,
                    'first_name'       => $request->first_name,
                    'last_name'        => $request->last_name,
                    'email'            => $request->email,
                    'country'          => $request->country,
                    'message'          => $request->message,
                    'anonymous'        => $request->anonymous,
                    'payment_status'   => 'completed',
                    'payment_intent_id'=> $out['transaction_id'] ?? null,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Donation submitted successfully! Your donation number is ' . $donation->donation_number,
                    'data'    => $donation,
                ], 201);
            }

            // Map some common failure detail back to the client to help debugging
            $message = $out['error_explanation']
                ?? $out['response_cardSecurityCode']['acquirerCode'] ?? null
                ?? 'Payment processing failed';

            return response()->json([
                'success' => false,
                'message' => $message,
                'raw'     => $out,
            ], 400);

        } catch (\Throwable $e) {
            Log::error('COMMBANK_PAY_ERROR', ['ex' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to process donation. Please try again.',
            ], 500);
        }
    }
    

    /*
    public function processDonation(Request $request)
    {
        $rules = [
            'nonce' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'tipPercentage' => 'required|numeric|min:0',
            'coverTransactionCosts' => 'required|boolean',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone-number' => 'required|string|max:15',
            'country' => 'required|string|max:100',
            'message' => 'nullable|string|max:1000',
        ];
    
        $validator = \Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed. Please check the highlighted fields.',
            ], 422);
        }
    
        $validatedData = $validator->validated();
    
        $phoneNumber = $validatedData['phone-number'];
        $coverTransactionCosts = $validatedData['coverTransactionCosts'];
    
        $donationAmount = $validatedData['amount'];
        $tipAmount = $donationAmount * ($validatedData['tipPercentage'] / 100);
        $transactionFee = $donationAmount * 0.029 + 0.30; 
        $totalAmount = $donationAmount + $tipAmount + $transactionFee;
    
        if ($coverTransactionCosts) {
            $totalAmount += $transactionFee;
        }
    
        \Log::info('Processing donation', [
            'donation_amount' => $donationAmount,
            'tip_amount' => $tipAmount,
            'transaction_fee' => $transactionFee,
            'total_amount' => $totalAmount,
        ]);
    
        try {
            \DB::beginTransaction();
    
            $donation = \App\Models\Donation::create([
                'user_id' => auth()->id(),
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $phoneNumber,
                'country' => $validatedData['country'],
                'message' => $validatedData['message'] ?? null,
                'amount' => $donationAmount,
                'tip' => $tipAmount,
                'transaction_fee' => $transactionFee,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);
    
            $paymentResponse = $this->createPayment($validatedData['nonce'], $totalAmount, $donation->id);
    
            if ($paymentResponse['success']) {
                $donation->update([
                    'status' => 'successful',
                    'payment_id' => $paymentResponse['payment_id'],
                ]);
    
                \DB::commit();
                \Mail::to($validatedData['email'])->send(new \App\Mail\DonationConfirmationMail($donation));
                return response()->json([
                    'success' => true,
                    'message' => 'Donation successful!',
                    'redirect_url' => route('donation.success'),
                ]);
            } else {
                \DB::rollBack();
                \Log::error('Donation payment failed', ['payment_response' => $paymentResponse]);
                \Mail::to($validatedData['email'])->send(new \App\Mail\DonationFailureMail($donation));
                return response()->json([
                    'success' => false,
                    'message' => 'Donation failed. Please try again.',
                ], 500);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error processing donation', ['error_message' => $e->getMessage()]);
    
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the donation. Please try again.',
            ], 500);
        }
    }

    private function createPayment($nonce, $totalAmount, $donationId)
    {
        try {
            $square = new \Square\SquareClient([
                'accessToken' => config('services.square.access_token'),
                'environment' => config('services.square.environment'),
            ]);

            $paymentsApi = $square->getPaymentsApi();
            $paymentRequest = new \Square\Models\CreatePaymentRequest(
                $nonce,
                uniqid(),
                $totalAmount,
                'AUD'
            );

            $paymentResponse = $paymentsApi->createPayment($paymentRequest);

            if ($paymentResponse->isSuccess()) {
                // Payment successful, return response with payment details
                return [
                    'success' => true,
                    'payment_id' => $paymentResponse->getResult()->getPayment()->getId(),
                ];
            } else {
                // Payment failed, return failure message
                return [
                    'success' => false,
                    'message' => $paymentResponse->getErrors(),
                ];
            }
        } catch (Exception $e) {
            Log::error('Error processing payment with Square', ['error_message' => $e->getMessage()]);
            return [
                'success' => false,
                'message' => 'Payment processing error. Please try again.',
            ];
        }
    }
    */


}
