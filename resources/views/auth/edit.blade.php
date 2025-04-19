
@extends('layouts.app')

@section('content')

<x-guest-layout>
    <form method="POST" action="{{ route('update') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Postal_code -->
        <div>
            <x-input-label for="postal_code" :value="__('Postal_code')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" value="{{$user->postal_code}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>
        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{$user->address}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
        <!-- Phone-->
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{$user->phone}}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
    
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('更新') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection