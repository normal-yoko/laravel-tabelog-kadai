<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;



class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'パスワードの更新は完了しました。');
    }

   
   // パスワード変更のためのフォーム
   public function editPassword()
   {
       return view('auth.password-edit');
   }

   // パスワードの更新
   public function updatePassword(Request $request)
   {
       $request->validate([
           'current_password' => ['required', 'string'],
           'password' => ['required', 'confirmed'],
       ]);

       $user = Auth::user();

       // 現在のパスワードが一致するか確認
       if (!Hash::check($request->current_password, $user->password)) {
           return back()->withErrors(['current_password' => 'Current password does not match.']);
       }

       $user->password = Hash::make($request->password);
       $user->save();

       return redirect()->route('stores.index')->with('status', 'パスワードの変更は完了しました。');
   }
}
