<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function index()
    {

        $total = 3000;

        return view('checkout.index', compact('total'));
    }

    public function store(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $line_items = [];

        $checkout_session = Session::create([
            'line_items' => '会費',
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.index'),
        ]);

        return redirect($checkout_session->url);
    }

    public function success()
    {
        return view('checkout.success');
    }
}