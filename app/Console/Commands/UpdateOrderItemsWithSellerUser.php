<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StoreOrderItem;
use App\Models\BusinessProduct;
use Illuminate\Support\Facades\DB;

class UpdateOrderItemsWithSellerUser extends Command
{
    protected $signature = 'orderitems:update-seller-user';

    protected $description = 'Update seller_id and user_id in existing store_order_items';

    public function handle()
    {
        $this->info('Updating order items...');

        $items = StoreOrderItem::whereNull('seller_id')
            ->orWhereNull('user_id')
            ->get();

        $bar = $this->output->createProgressBar($items->count());

        foreach ($items as $item) {
            $product = BusinessProduct::with('businessInfo')->find($item->product_id);

            if ($product) {
                $item->seller_id = $product->business_id;
                $item->user_id = optional($product->businessInfo)->user_id;
                $item->save();
            }

            $bar->advance();
        }

        $bar->finish();

        $this->info("\nUpdate complete.");
    }
}
