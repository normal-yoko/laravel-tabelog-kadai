<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $user = Auth::user();
    
        // 新規カスタマー作成
        if (!$user->stripe_customer_id) {
            $customer = \Stripe\Customer::create([
                'email' => $user->email,
                'name'  => $user->name,
            ]);
            $user->stripe_customer_id = $customer->id;
            $user->save();
        }
    
        $line_items = [
            [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => '会費',
                    ],
                    'unit_amount' => 300,
                ],
                'quantity' => 1,
            ],
        ];
    
        $checkout_session = Session::create([
            'customer' => $user->stripe_customer_id,  // カスタマーIDを使用
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

    public function updateCard()
    {
        $user = Auth::user();
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $session = Session::create([
            'mode' => 'setup', 
            'customer' => $user->stripe_customer_id,
            'payment_method_types' => ['card'], 
            'success_url' => route('checkout.updateCard.success'),
            'cancel_url' => route('stores.index'),
        ]);
    
        return redirect($session->url);
    }
    
    public function updateCardSuccess()
    {
        // 特にDB変更不要。Stripe側で支払い方法が更新される
        return redirect()->route('stores.index')->with('message', 'カード情報を更新しました');
    }

    public function destroy()
    {
        $user = Auth::user();
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        if ($user->stripe_customer_id) {
            try {
                // 支払い方法（カード）を取得
                $paymentMethods = \Stripe\PaymentMethod::all([
                    'customer' => $user->stripe_customer_id,
                    'type' => 'card',
                ]);
    
                // 各カードをdetach（顧客から切り離し）
                foreach ($paymentMethods->data as $paymentMethod) {
                    // Detach the card from the customer
                    $paymentMethod->detach();
                    \Log::info('Detached card: ' . $paymentMethod->id); // ログでカードIDを確認
                }
    
                // 顧客を削除
                $customer = \Stripe\Customer::retrieve($user->stripe_customer_id);
                $customer->delete(); // 顧客情報を完全削除
                \Log::info('Deleted Stripe customer: ' . $user->stripe_customer_id); // ログで顧客IDを確認
    
            } catch (\Exception $e) {
                \Log::error('Stripe Customer/Card Delete Error: ' . $e->getMessage());
            }
        }
    
        // アプリ側の情報もリセット
        $user->update([
            'paid_flg' => false,
            'stripe_customer_id' => null,
        ]);
    
        return redirect()->route('stores.index')->with('message', '有料会員を解約し、カード情報も削除しました。');
    }
    
}