<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $line_items = [
            [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => '会費',
                    ],
                    'unit_amount' => 3000,
                ],
                'quantity' => 1,
            ],
        ];

        $checkout_session = Session::create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('stores.index'),
        ]);

        return redirect($checkout_session->url);
    }

    public function success()
    {
        $user_id = auth::user()->id;
        $user = User::find($user_id);
        $user->paid_flg=true;
        $user->update();

     return to_route('stores.index');
    }

    public function destroy()
    {
        $user_id = auth::user()->id;
        $user = User::find($user_id);
        $user->paid_flg=false;
        $user->update();

     return to_route('stores.index');
    }


}