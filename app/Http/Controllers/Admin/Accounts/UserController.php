<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  
    public function index()
    {
        $users = User::where('status', 'active')->orderBy('id', 'desc')->paginate(20); 
        return view('admin.pages.accounts.user', compact('users'));
    }    

    public function destroy($id)
    {
        $user = User::findOrFail($id);
    
        try {
            $user->update(['status' => 'deleted']);  
            return redirect()->route('admin.pages.accounts.user')->with('success', 'Deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.pages.accounts.user')->with('error', 'An error occurred. Please try again.');
        }
    }
}
