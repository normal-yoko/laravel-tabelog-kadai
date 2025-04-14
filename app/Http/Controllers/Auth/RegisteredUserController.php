<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'postal_code' => ['required','digits:7'],    //追加
            'address' => ['required','max:30'],          //追加
            'phone' => ['required','numeric','digits_between:10,11'],    //追加
        ]); 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'postal_code' => $request->postal_code,  //追加
            'address' => $request->address,  //追加
            'phone' => $request->phone, //追加
        ]);

        event(new Registered($user));

        Auth::login($user);

//        return redirect(RouteServiceProvider::HOME);
        return redirect('/verify-email');
    }

    public function edit()
    {
        $user = Auth::user();

        return view('auth.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->postal_code = $request->input('postal_code');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->password = $request->input('password');
        

        $user->update();

        return to_route('stores.index');
    }
}