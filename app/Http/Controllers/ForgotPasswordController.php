<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetOtpMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('customer.auth.forgot-password');
    }

    public function sendResetOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }
    
        // Generate OTP (6 digits)
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpExpiresAt = Carbon::now()->addMinutes(5);
    
        $user->update([
            'password_reset_otp' => $otp,
            'password_reset_otp_expires_at' => $otpExpiresAt
        ]);
    
        // Send OTP email
        Mail::to($user->email)->send(new PasswordResetOtpMail($otp));
    
        // Store email in session
        $request->session()->put('password_reset_email', $user->email);
    
        return redirect()->route('password.verify')
            ->with('email', $user->email)
            ->with('success', 'We have emailed your password reset OTP!');
    }
    
    public function resendOtp(Request $request)
    {
        $email = $request->session()->get('password_reset_email');
        
        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Session expired. Please request a new OTP.']);
        }
    
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'User not found.']);
        }
    
        // Generate new OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpExpiresAt = Carbon::now()->addMinutes(5);
    
        $user->update([
            'password_reset_otp' => $otp,
            'password_reset_otp_expires_at' => $otpExpiresAt
        ]);
    
        // Resend OTP email
        Mail::to($user->email)->send(new PasswordResetOtpMail($otp));
    
        return back()->with('success', 'A new verification code has been sent to your email.');
    }

    public function showVerifyForm()
    {
        if (!session('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('customer.auth.verify-otp-password');
    }

    public function verifyOtp(Request $request)
{
    $request->validate(['otp' => 'required|digits:6']);

    $email = $request->session()->get('password_reset_email');
    $user = User::where('email', $email)->first();

    if (!$user) {
        return redirect()->route('password.request')
            ->withErrors(['email' => 'User not found.']);
    }

    if ($user->password_reset_otp !== $request->otp) {
        return back()->withErrors(['otp' => 'Invalid Verification Code.']);
    }

    if (Carbon::now()->gt($user->password_reset_otp_expires_at)) {
        return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
    }

    // Save token if not already set
    if (!$user->password_reset_token) {
        $user->password_reset_token = Str::random(64);
        $user->save();
    }

    $request->session()->put('otp_verified', true);

    return redirect()->route('password.reset', ['token' => $user->password_reset_token]);
}


    public function showResetForm($token)
    {
        // Check if OTP was verified
        if (!session('otp_verified')) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Please verify OTP first.']);
        }

        $user = User::where('password_reset_token', $token)->first();
        
        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Invalid password reset link.']);
        }

        return view('customer.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);
    
        $user = User::where('password_reset_token', $request->token)->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'Invalid or expired password reset token.']);
        }
    
        // Update the user's password
        $user->update([
            'password' => Hash::make($request->password),
            'password_reset_token' => null,
            'password_reset_otp' => null,
            'password_reset_otp_expires_at' => null
        ]);
    
        return redirect()->route('login')->with('success', 'Your password has been reset!');
    }
        
}