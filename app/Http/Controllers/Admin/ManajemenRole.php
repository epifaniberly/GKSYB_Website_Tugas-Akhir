<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rules\Password;

class ManajemenRole extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        \Log::info('Entering sendVerificationCode with email: ' . $request->email);
        
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email'
            ], [
                'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain untuk user baru.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('Validation failed for OTP: ' . json_encode($e->errors()));
            return response()->json([
                'status' => 'error', 
                'message' => $e->validator->errors()->first()
            ], 422);
        }
        
        $code = rand(100000, 999999);
        Cache::put('otp_' . $request->email, $code, now()->addMinutes(15));
        
        try {
            \Log::info("Attempting to send OTP to email {$request->email}: $code");

            Mail::send('emails.verification_code', ['code' => $code], function($msg) use ($request) {
                $msg->to($request->email)->subject('Kode Verifikasi Admin GKSYB');
            });
            
            \Log::info("OTP successfully sent to {$request->email}");
            return response()->json(['status' => 'success', 'message' => 'Kode verifikasi telah dikirim ke email.']);
        } catch (\Exception $e) {
            \Log::error("Failed to send OTP to {$request->email}. Error: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal kirim email: ' . $e->getMessage()], 500);
        }
    }

    public function sendAdminSecurityCode(Request $request)
    {
        \Log::info('Entering sendAdminSecurityCode with user_id: ' . $request->user_id);
        
        try {
            $request->validate(['user_id' => 'required|exists:users,id']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('Security OTP validation failed: ' . json_encode($e->errors()));
            return response()->json(['status' => 'error', 'message' => $e->validator->errors()->first()], 422);
        }

        $targetUser = User::findOrFail($request->user_id);
        
        $code = rand(100000, 999999);
        Cache::put('security_otp_' . $targetUser->email, $code, now()->addMinutes(15));
        
        try {
            \Log::info("Attempting to send security OTP to User {$targetUser->email}: $code");

            Mail::send('emails.verification_code', ['code' => $code], function($msg) use ($targetUser) {
                $msg->to($targetUser->email)->subject('Kode Verifikasi Keamanan - GKSYB');
            });
            
            \Log::info("Security OTP successfully sent to {$targetUser->email}");
            return response()->json(['status' => 'success', 'message' => 'Kode verifikasi telah dikirim ke email user: ' . $targetUser->email]);
        } catch (\Exception $e) {
            \Log::error("Failed to send security OTP to {$targetUser->email}. Error: " . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Gagal kirim email: ' . $e->getMessage()], 500);
        }
    }

    public function checkAdminSecurityCode(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'code' => 'required'
        ]);
        
        $targetUser = User::findOrFail($request->user_id);
        $cached = Cache::get('security_otp_' . $targetUser->email);
        
        if ($cached && $cached == $request->code) {
            return response()->json(['status' => 'valid', 'message' => 'Verifikasi berhasil!']);
        }
        
        return response()->json(['status' => 'invalid', 'message' => 'Kode keamanan salah atau kadaluarsa.'], 400);
    }

    public function checkVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required'
        ]);

        $cached = Cache::get('otp_' . $request->email);
        
        if ($cached && $cached == $request->code) {
            return response()->json(['status' => 'valid', 'message' => 'Email terverifikasi!']);
        }
        
        return response()->json(['status' => 'invalid', 'message' => 'Kode verifikasi salah atau kadaluarsa.'], 400);
    }

    public function index()
    {
        $komsos = User::where('role_type', 2)->get();
        $sekre = User::where('role_type', 1)->get();
        return view('admin.pages.role.index', compact('komsos', 'sekre'));
    }

    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols(), 'regex:/^\S*$/'],
            'role_type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('manual_errors', $validator->errors())->withInput();
        }

        try {

            $data = $request->only(['name', 'email', 'role_type']);

            $data['password'] = Hash::make($request->password);

            $user = User::create($data);
            event(new Registered($user));

            if ($request->hasFile('foto_profil')) {
                if(!\Storage::exists('public/ProfileMedia')) \Storage::makeDirectory('public/ProfileMedia');
                
                $file = $request->file('foto_profil');
                $ext = $file->getClientOriginalExtension();
                $fileName = 'profile-' . $user->id . '.' . $ext;
                $file->storeAs('public/ProfileMedia', $fileName);
                $user->update(['foto_profil' => $fileName]);
            }

            return redirect()->back()->with('swal_success', 'User berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', 'Gagal menambah user: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols(), 'regex:/^\S*$/'],
            'role_type' => 'sometimes|required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('manual_errors', $validator->errors())->withInput();
        }

        try {
            $user = User::findOrFail($id);

            $data = $request->only(['name', 'email', 'role_type']);

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('foto_profil')) {
                if ($user->foto_profil && \Storage::exists('public/ProfileMedia/' . $user->foto_profil)) {
                    \Storage::delete('public/ProfileMedia/' . $user->foto_profil);
                }
                
                if(!\Storage::exists('public/ProfileMedia')) \Storage::makeDirectory('public/ProfileMedia');

                $file = $request->file('foto_profil');
                $ext = $file->getClientOriginalExtension();
                $fileName = 'profile-' . $user->id . '.' . $ext;
                $file->storeAs('public/ProfileMedia', $fileName);
                $data['foto_profil'] = $fileName;
            } else {
                 unset($data['foto_profil']);
            }

            $user->update($data);
            
            $message = $request->filled('password') ? 'Password berhasil diperbarui' : 'User berhasil diperbarui';

            return redirect()->back()->with('swal_success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', 'Gagal update user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->foto_profil && \Storage::exists('public/ProfileMedia/' . $user->foto_profil)) {
                \Storage::delete('public/ProfileMedia/' . $user->foto_profil);
            }
            $user->delete();

            return redirect()->back()->with('swal_success', 'User berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()->with('swal_error', 'Gagal hapus user: ' . $e->getMessage());
        }
    }
}
