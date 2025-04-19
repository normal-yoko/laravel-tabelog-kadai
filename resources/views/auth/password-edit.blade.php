@extends('layouts.app')

@section('content')
<x-guest-layout>
    <h2 class="text-lg font-medium text-gray-900 mb-4">パスワード変更</h2>

    @if (session('status'))
        <div class="mb-4 text-green-600 font-medium">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- 現在のパスワード -->
        <div class="mt-4">
            <x-input-label for="current_password" :value="'現在のパスワード'" />
            <x-text-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <!-- 新しいパスワード -->
        <div class="mt-4">
            <x-input-label for="password" :value="'新しいパスワード'" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- 新しいパスワード（確認） -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'新しいパスワード（確認）'" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <!-- 送信ボタン -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                パスワード更新
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection
