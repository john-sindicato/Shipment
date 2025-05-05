<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => [
                'required',
                'regex:/^(09\d{9}|0\d{2,3}-\d{3,4}-\d{3,4})$/',
            ],
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'password_confirmation' => 'required',
        ], [
            'fname.required' => 'First name is required.',
            'lname.required' => 'Last name is required.',
    
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Please enter a valid Philippine phone number (e.g., 09123456789 or 02-1234-5678).',
            'phone.unique' => 'This phone number is already registered.',
    
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
    
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'Passwords do not match.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password_confirmation.required' => 'Please confirm your password.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $existingUser = User::where('email', $request->email)
            ->orWhere('phone', $request->phone)
            ->first();
     
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpExpiresAt = Carbon::now()->addMinutes(5);
    
        $userData = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => $otpExpiresAt,
            'email_verified' => false,
            'status' => 'inactive',  
        ];
    
        if ($existingUser) {
            if ($existingUser->status === 'active') {
                return redirect()->back()
                    ->withErrors([
                        'phone' => 'This phone number is already registered.',
                        'email' => 'This email is already registered.'
                    ])
                    ->withInput();
            } else {
                // For 'deleted', 'inactive', or any other status, update and use the existing user
                $existingUser->update($userData);
                $user = $existingUser;
            }
        } else {
            // Create new inactive user
            $user = User::create($userData);
        }
    
        // Send OTP email
        Mail::to($user->email)->send(new OtpMail($otp));
    
        // Store user ID in session for verification
        $request->session()->put('verification_user_id', $user->id);
    
        return redirect()->route('verification.notice')
            ->with('success', 'A verification code has been sent to your email. Please check your inbox.');
    }

    public function showVerificationForm(Request $request)
    {
        $userId = $request->session()->get('verification_user_id');
    
        if (!$userId) {
            return redirect()->route('sign_up')->with('error', 'You need to register first.');
        }
    
        $user = User::find($userId);
    
        if (!$user) {
            return redirect()->route('sign_up')->with('error', 'User not found.');
        }
    
        if ($user->email_verified) {
            return redirect()->route('home');
        }
    
        return view('customer.auth.verify-otp');
    }
    
    
    public function verifyOtp(Request $request)
    {
        // Validate the OTP input to ensure it's a 6-digit string
        $request->validate([
            'otp' => 'required|digits:6'
        ]);
    
        // Retrieve the session value to get the user ID
        $userId = $request->session()->get('verification_user_id');
        if (!$userId) {
            return redirect()->route('sign_up')->with('error', 'Session expired. Please register again.');
        }
    
        // Find the user based on the stored user ID in the session
        $user = User::find($userId);
    
        // If the user is not found, redirect with an error
        if (!$user) {
            return redirect()->route('sign_up')->with('error', 'User not found. Please register again.');
        }
    
        // Get the OTP from the form input (it's now a single string)
        $otp = $request->otp;
    
        // Check if the OTP matches the one stored in the database
        if ($user->otp !== $otp) {
            return back()->withErrors(['otp' => 'Invalid verification code.'])->withInput();
        }
    
        // Check if the OTP has expired
        if (Carbon::now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Verification code has expired.'])->withInput();
        }
    
        // Mark email as verified and activate account
        $user->update([
            'email_verified' => true,
            'otp' => null,
            'otp_expires_at' => null,
            'status' => 'active' // Set status to active after verification
        ]);
    
        // Clear the session to remove the temporary user data
        $request->session()->forget('verification_user_id');
     
        return redirect()->route('login')->with('success', 'Email verified successfully! You may now login.');
    }
    
    
    public function resendOtp(Request $request)
    {
        $userId = $request->session()->get('verification_user_id');
        if (!$userId) {
            return redirect()->route('sign_up')->with('error', 'Session expired. Please register again.');
        }
    
        $user = User::find($userId);
     
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpExpiresAt = Carbon::now()->addMinutes(5);
    
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => $otpExpiresAt,
            'status' => 'inactive'  
        ]);
     
        Mail::to($user->email)->send(new OtpMail($otp));
    
        return back()->with('success', 'A new verification code has been sent to your email.');
    }



    
    public function showChangeEmailForm()
    {
        return view('auth.change-email');
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);

        $oldEmail = $request->session()->get('verification_email');
        $user = User::where('email', $oldEmail)->first();

        if (!$user) {
            return redirect()->route('register')->with('error', 'Session expired. Please register again.');
        }

        // Generate new OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpExpiresAt = Carbon::now()->addMinutes(5);

        $user->update([
            'email' => $request->email,
            'otp' => $otp,
            'otp_expires_at' => $otpExpiresAt
        ]);

        // Send OTP to new email
        Mail::to($request->email)->send(new OtpMail($otp));

        // Update session with new email
        $request->session()->put('verification_email', $request->email);

        return redirect()->route('verification.notice')
            ->with('success', 'Email updated successfully. A new verification code has been sent.');
    }
}
