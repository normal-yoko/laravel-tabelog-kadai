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
        // StripeのAPIキーを設定
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
            'customer' => $user->stripe_customer_id,
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('stores.index'),
            'payment_intent_data' => [
                'setup_future_usage' => 'off_session', 
            ],
        ]);
    
        return redirect($checkout_session->url);
    } 

    public function success()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->paid_flg=true;
        $user->update();

     return to_route('stores.index')->with('status', '有料会員登録が完了しました。');
    }

    public function updateCard()
    {
        $user = Auth::user();
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $session = Session::create([
            'mode' => 'setup', 
            'customer' => $user->stripe_customer_id,
            'payment_method_types' => ['card'], 
            'success_url' => route('checkout.updateCard.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stores.index'),
        ]);
    
        return redirect($session->url);
    }

    public function updateCardSuccess(Request $request)
{
  Stripe::setApiKey(env('STRIPE_SECRET'));

    // セッションIDを取得
    $session_id = $request->get('session_id');
    if (!$session_id) {
        return redirect()->route('stores.index')->with('error', 'セッションIDが正しくありません。');
    }

    try {
        // セッションを取得
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        // setup_intent を取得
        $setupIntent = \Stripe\SetupIntent::retrieve($session->setup_intent);

        // setup_intent から支払い方法のIDを取得
        $paymentMethodId = $setupIntent->payment_method;

        // 支払い方法を顧客に関連付け
        $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId); // 支払い方法を取得
        $paymentMethod->attach(['customer' => $session->customer]); // 顧客に関連付け

        // 支払い方法をデフォルトに設定することもできます
        \Stripe\Customer::update(
            $session->customer,
            ['invoice_settings' => ['default_payment_method' => $paymentMethodId]]
        );

        // メッセージを表示して、リダイレクト
        return redirect()->route('stores.index')->with('status  ', 'カード情報を更新しました');
    } catch (\Exception $e) {
        \Log::error('Error during payment method attach: ' . $e->getMessage());
        return redirect()->route('stores.index')->with('error', 'カード情報の更新中にエラーが発生しました。');
    }
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
    
        return redirect()->route('stores.index')->with('status', '有料会員を解約し、カード情報も削除しました。');
    }
 
    public function showCard()
    {

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = Auth::user();
        
        try {
            $paymentMethods = \Stripe\PaymentMethod::all([
                'customer' => $user->stripe_customer_id,
                'type' => 'card',
            ]);
            
            \Log::info('Payment Methods:', ['payment_methods' => $paymentMethods]);  // ここでログを確認
    
            $card = count($paymentMethods->data) > 0 ? $paymentMethods->data[0] : null;
            
            return view('checkout.card', [
                'card' => $card,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error retrieving card info: ' . $e->getMessage());
            return redirect()->route('stores.index')->with('error', 'カード情報の取得に失敗しました。');
        }
    }
    
}