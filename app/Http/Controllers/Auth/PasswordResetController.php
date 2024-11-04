<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Tampilkan form forgot password.
     */
    public function showForgotPasswordForm()
    {
        return view('forgot');
    }

    /**
     * Mengirim link reset password ke email pengguna.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validasi input email
        $request->validate(['email' => 'required|email']);

        // Kirim link reset password
        $status = Password::sendResetLink(
            $request->only('email')
        );
        // dd('berhasil', $request->all());

        // Periksa apakah email berhasil dikirim
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        // Jika gagal, kembalikan error
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    /**
     * Tampilkan form reset password.
     */
    public function showResetForm($token)
    {
        return view('resetPassword', ['token' => $token]);
    }

    /**
     * Update password pengguna.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
