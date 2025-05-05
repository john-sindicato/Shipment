<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; 
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'This email is not registered'])->withInput();
        }
     
        if ($user->status === 'deleted') {
            return back()->withErrors(['email' => 'Your account has been deleted. Please contact support.'])->withInput();
        }
    
        if ($user->status === 'inactive') {
            // Store email in session for verification flow
            $request->session()->put('verification_email', $user->email);
            
            // Check if OTP exists and is not expired
            if ($user->otp && Carbon::parse($user->otp_expires_at)->isFuture()) {
                return redirect()->route('verification.notice')
                    ->with('error', 'Your account is not yet verified. Please enter the OTP sent to your email.');
            }
            
            // Generate new OTP if expired or doesn't exist
            $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $otpExpiresAt = Carbon::now()->addMinutes(5);
            
            $user->update([
                'otp' => $otp,
                'otp_expires_at' => $otpExpiresAt
            ]);
            
            Mail::to($user->email)->send(new OtpMail($otp));
            
            return redirect()->route('verification.notice')
                ->with('error', 'Your account is not yet verified. A new verification code has been sent to your email. Please check and enter the code.');
        }
    
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->withErrors(['password' => 'Incorrect password'])->withInput();
        }
    
        session(['user_email' => $request->email]);
        return redirect()->route('home');
    }
}

