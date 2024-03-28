<?php

namespace App\Listeners;

use App\Models\Rentable;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class ReaddItemsOnLogout
{
    public function handle(Logout $event)
    {
        $rentablesArray = Session::get('rentables');

        if ($rentablesArray) {
            foreach ($rentablesArray as $rentable) {
                $product = Rentable::findOrFail($rentable['id']);
                $product->update([
                    'quantity' => $product->quantity + 1
                ]);
            }

            Session::forget('rentables');
        }
    }
}
