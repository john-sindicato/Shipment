<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

class TellerController extends Controller
{
    public function store(Request $request)
    { 
        $existingTeller = Teller::where('phone', $request->phone)
            ->orWhere('email', $request->email)
            ->first();

        if ($existingTeller) {
            if ($existingTeller->status === 'active') {
                return redirect()->back()
                    ->with('error_phone', 'Phone number already exists.')
                    ->with('error_email', 'Email address already exists.')
                    ->withInput();
            } elseif ($existingTeller->status === 'deleted') {
                $existingTeller->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'street' => $request->street,
                    'brgy' => $request->brgy,
                    'city' => $request->city,
                    'province' => $request->province,
                    'zipcode' => $request->zipcode,
                    'branch' => $request->branch,
                    'profile' => $existingTeller->profile,   
                    'status' => 'active',  
                ]);

                return redirect()->back()->with('success', 'Teller account has been reactivated!');
            }
        }
    
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'phone' => [
                'required',
                'regex:/^(09\d{9}|0\d{2,3}-\d{3,4}-\d{3,4})$/',
                'unique:teller,phone'
            ],
            'email' => 'required|email|unique:teller,email',
            'street' => 'required|string|max:255',
            'brgy' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
            'branch' => 'required|string|max:255',
            'profile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $profilePath = null;
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $profilePath = 'profiles/' . $filename;

            if (!$file->move(public_path('profiles'), $filename)) {
                return back()->with('error', 'Failed to move uploaded file.');
            }
        }
    
        Teller::create([
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'dob' => $validatedData['dob'],
            'gender' => $validatedData['gender'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'street' => $validatedData['street'],
            'brgy' => $validatedData['brgy'],
            'city' => $validatedData['city'],
            'province' => $validatedData['province'],
            'zipcode' => $validatedData['zipcode'],
            'branch' => $validatedData['branch'],
            'profile' => $profilePath,
            'password' => Hash::make('teller123'),  
            'status' => 'active',
        ]);

        return back()->with('success', 'Teller registered successfully!');
    }

    public function index()
    {
        $tellers = Teller::where('status', 'active')->orderBy('id', 'desc')->paginate(20); 
        return view('admin.pages.accounts.teller', compact('tellers'));
    }
      

    public function destroy($id)
    {
        $teller = Teller::findOrFail($id);
    
        try {
            $teller->update(['status' => 'deleted']);  
            return redirect()->route('admin.pages.accounts.teller')->with('success', 'Deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.pages.accounts.teller')->with('error', 'An error occurred. Please try again.');
        }
    }


        public function update(Request $request, $id)
        {
            $request->validate([
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'dob' => 'required|date',
                'gender' => 'required|string',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'street' => 'required|string|max:255',
                'brgy' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'zipcode' => 'required|string|max:10',
                'branch' => 'required|string|max:255',
                'profile' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            ]);
        
            $teller = Teller::findOrFail($id);
        
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $profilePath = 'profiles/' . $filename;
        
                if ($file->move(public_path('profiles'), $filename)) {
                    $teller->profile = $profilePath;
                } else {
                    return back()->with('error', 'Failed to move uploaded file.');
                }
            }
        
            $teller->fname = $request->fname;
            $teller->lname = $request->lname;
            $teller->dob = $request->dob;
            $teller->gender = $request->gender;
            $teller->phone = $request->phone;
            $teller->email = $request->email;
            $teller->street = $request->street;
            $teller->brgy = $request->brgy;
            $teller->city = $request->city;
            $teller->province = $request->province;
            $teller->zipcode = $request->zipcode;
            $teller->branch = $request->branch;
            $teller->save();  
        
            return redirect()->back()->with('success', 'Updated successfully!');
        }        



        public function changePassword(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'new_password' => [
                    'required',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
                ],
                'confirm_password' => 'required|same:new_password',
            ], [
                'current_password.required' => 'Please enter your current password.',
                'new_password.required' => 'Please enter a new password.',
                'new_password.min' => 'New password must be at least 8 characters.',
                'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
                'confirm_password.required' => 'Please confirm your new password.',
                'confirm_password.same' => 'Confirmation password does not match.',
            ]);

            $teller = Teller::where('email', session('teller_email'))->first();

            if (!$teller) {
                return redirect()->route('teller.login')->with('error', 'Please log in to change your password.');
            }

            if (!\Hash::check($request->current_password, $teller->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }

            $teller->password = \Hash::make($request->new_password);
            $teller->save();

            return back()->with('success', 'Password changed successfully!');
        }

}
