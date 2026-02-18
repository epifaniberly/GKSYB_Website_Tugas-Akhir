<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;

class ForgotPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('auth.forgot-password.email');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar dalam sistem kami.']);
        }

        $otp = rand(100000, 999999);
        Cache::put('forgot_password_otp_' . $request->email, $otp, now()->addMinutes(10));

        try {
            \Log::info("Forgot Password OTP for {$request->email}: $otp");

            Mail::send('emails.verification_code', ['code' => $otp], function($msg) use ($request) {
                $msg->to($request->email)->subject('Reset Password Admin GKSYB');
            });

            Alert::success('Berhasil', 'Kode verifikasi baru telah dikirim ke email Anda.');
            return redirect()->route('password.otp', ['email' => $request->email]);
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat mengirim email: ' . $e->getMessage());
            return back();
        }
    }

    public function showOtpForm(Request $request)
    {
        return view('auth.forgot-password.otp', ['email' => $request->email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $cachedOtp = Cache::get('forgot_password_otp_' . $request->email);

        if ($cachedOtp && $cachedOtp == $request->otp) {
            $resetToken = bin2hex(random_bytes(32));
            Cache::put('reset_token_' . $request->email, $resetToken, now()->addMinutes(10));
            
            return redirect()->route('password.reset', ['email' => $request->email, 'token' => $resetToken]);
        }

        return back()->withErrors(['otp' => 'Kode verifikasi tidak valid atau sudah kadaluarsa.']);
    }

    public function showResetForm(Request $request)
    {
        $token = Cache::get('reset_token_' . $request->email);
        
        if (!$token || $token !== $request->token) {
            Alert::error('Sesi Berakhir', 'Sesi reset password Anda telah berakhir. Silakan coba lagi.');
            return redirect()->route('password.request');
        }

        return view('auth.forgot-password.reset', [
            'email' => $request->email,
            'token' => $request->token
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols(), 'regex:/^\S*$/'],
        ]);

        $token = Cache::get('reset_token_' . $request->email);

        if (!$token || $token !== $request->token) {
            return redirect()->route('password.request')->withErrors(['email' => 'Sesi tidak valid.']);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update(['password' => Hash::make($request->password)]);
            
            Cache::forget('forgot_password_otp_' . $request->email);
            Cache::forget('reset_token_' . $request->email);

            Alert::success('Berhasil', 'Password Anda telah berhasil diperbarui. Silakan login kembali.');
            return redirect()->route('login.index');
        }

        return back()->withErrors(['email' => 'User tidak ditemukan.']);
    }
}
