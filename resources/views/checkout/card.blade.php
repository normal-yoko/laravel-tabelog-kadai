@extends('layouts.app')

@section('content')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
       </div>
@endif

<div class="container py-5">
    <h2 class="fw-bold text-center mb-4" style="font-family: 'Comic Sans MS', cursive, sans-serif; color: #4CAF50;"> 現在のカード情報</h2>

    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 mb-6">
        @if ($card)
            <div class="mb-3 flex justify-between">
                <span class="text-gray-600 font-medium w-40">カードブランド:</span>
                <span class="text-gray-800 capitalize">{{ $card->card->brand }}</span>
            </div>

            <div class="mb-3 flex justify-between">
                <span class="text-gray-600 font-medium w-40">カード番号:</span>
                <span class="text-gray-800 tracking-widest">**** **** **** {{ $card->card->last4 }}</span>
            </div>

            <div class="mb-3 flex justify-between">
                <span class="text-gray-600 font-medium w-40">有効期限:</span>
                <span class="text-gray-800">{{ str_pad($card->card->exp_month, 2, '0', STR_PAD_LEFT) }}/{{ $card->card->exp_year }}</span>
            </div>

            <div class="text-center">
                <a href="{{ route('checkout.updateCard') }}" class="btn btn-warning" style="border-radius: 5px; background-color: #FFBC00; color: white; padding: 5px 10px; font-family: 'Comic Sans MS', cursive, sans-serif;">
                    カード情報を変更
                </a>
            </div>
        @else
            <p class="text-red-500">登録されたカード情報が見つかりません。</p>
            <div class="text-center">
                <a href="{{ route('checkout.updateCard') }}" class="btn btn-warning" style="border-radius: 5px; background-color: #FFBC00; color: white; padding: 5px 10px; font-family: 'Comic Sans MS', cursive, sans-serif;">
                    クレジットカード情報を追加する
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
