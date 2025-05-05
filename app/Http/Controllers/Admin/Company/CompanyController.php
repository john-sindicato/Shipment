<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function showForm()
    {
        $contactDetails = Company::first();

        return view('admin.pages.company.contact_details', compact('contactDetails'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $contactDetails = Company::firstOrNew([]);
        
        $contactDetails->address = $request->address;
        $contactDetails->phone = $request->phone;
        $contactDetails->email = $request->email;
        $contactDetails->save();  

        return redirect()->route('admin.pages.company.contact_details')->with('success', 'Saved successfully!');
    }
}