<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Database\QueryException;

class BranchController extends Controller
{
   
    public function branch_store(Request $request)
    {
        $validatedData = $request->validate([
            'province' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => [
                'required',
                'regex:/^(09\d{9}|0\d{2,3}-\d{3,4}-\d{3,4})$/'
            ],
            'email' => 'required|email|max:255',
        ]);
    
        $existingBranch = Branch::where('phone', $request->phone)
            ->orWhere('email', $request->email)
            ->first();
    
        if ($existingBranch) {
            if ($existingBranch->status === 'open') { 
                if ($existingBranch->phone === $request->phone && $existingBranch->email === $request->email) {
                    return redirect()->back()
                        ->with('error_phone', 'Phone number and email address already exist.')
                        ->withInput();
                } elseif ($existingBranch->phone === $request->phone) {
                    return redirect()->back()
                        ->with('error_phone', 'Phone number already exists.')
                        ->withInput();
                } elseif ($existingBranch->email === $request->email) {
                    return redirect()->back()
                        ->with('error_email', 'Email address already exists.')
                        ->withInput();
                }
            } elseif ($existingBranch->status === 'closed') {
                $existingBranch->update([
                    'province' => $validatedData['province'],
                    'address' => $validatedData['address'],
                    'contact_person' => $validatedData['contact_person'],
                    'phone' => $validatedData['phone'],
                    'email' => $validatedData['email'],
                    'status' => 'open',  
                ]);
    
                return redirect()->route('admin.pages.company.branch')
                    ->with('success', 'Branch has been reactivated!');
            }
        }
    
        try {
            Branch::create([
                'province' => $validatedData['province'],
                'address' => $validatedData['address'],
                'contact_person' => $validatedData['contact_person'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'status' => 'open',
            ]);
    
            return redirect()->route('admin.pages.company.branch')
                ->with('success', 'Branch added successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }    
    

    public function index()
    {
        $branches = Branch::where('status', '!=', 'deleted')
            ->orderBy('id', 'desc')
            ->paginate(20);
    
        return view('admin.pages.company.branch', compact('branches'));
    }
    
        
            public function edit($id)
            {
                $branch = Branch::findOrFail($id);
                return view('admin.pages.company.edit_branch', compact('branch'));
            }
            

            public function update(Request $request, $id)
            {
                $branch = Branch::findOrFail($id);
            
                $request->validate([
                    'province' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'contact_person' => 'required|string|max:255',
                    'phone' => [
                        'required',
                        'regex:/^(09\d{9}|0\d{2,3}-\d{3,4}-\d{3,4})$/'
                    ],
                    'email' => 'required|email|max:255',
                ]);
             
                if ($request->phone != $branch->phone && Branch::where('phone', $request->phone)->where('id', '!=', $id)->exists()) {
                    return redirect()->back()->with('error_phone', 'Phone number already exists.');
                }
            
                if ($request->email != $branch->email && Branch::where('email', $request->email)->where('id', '!=', $id)->exists()) {
                    return redirect()->back()->with('error_email', 'Email address already exists.');
                }
            
                try {
                    $branch->update([
                        'province' => $request->province,
                        'address' => $request->address,
                        'contact_person' => $request->contact_person,
                        'phone' => $request->phone,
                        'email' => $request->email,
                    ]);
            
                    return redirect()->route('admin.pages.company.branch')->with('success', 'Updated successfully!');
                } catch (QueryException $e) {
                    return redirect()->back()->with('error', 'An error occurred. Please try again.');
                }
            }
            
 
            

            public function destroy($id)
            {
                $branch = Branch::findOrFail($id);
            
                try {
                    $branch->update(['status' => 'deleted']);  
                    return redirect()->route('admin.pages.company.branch')->with('success', 'Deleted Successfully.');
                } catch (\Exception $e) {
                    return redirect()->route('admin.pages.company.branch')->with('error', 'An error occurred. Please try again.');
                }
            }            


            public function updateStatus(Request $request, $id)
            {
                $branch = Branch::findOrFail($id);
                $branch->status = $request->status;
                $branch->save();

                return response()->json(['success' => true, 'status' => $branch->status]);
            }




            public function index_branch()
            {
                $branches = Branch::orderBy('province', 'desc')->get();
                return view('customer.index', compact('branches'));
            }
}