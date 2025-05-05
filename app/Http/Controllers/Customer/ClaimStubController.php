<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ClaimStub;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class ClaimStubController extends Controller
{
    public function getClaimStubs()
    {
        $userEmail = auth()->user()->email;
    
        $stubs = ClaimStub::where('email', $userEmail)
            ->where('status', '!=', 'deleted')   
            ->orderBy('created_at', 'desc')
            ->get(['shipment_id', 'status', 'created_at']); 
    
        return response()->json($stubs);
    }

    public function markAsRead()
    {
        $userEmail = auth()->user()->email;

        ClaimStub::where('email', $userEmail)
            ->where('status', 'new')
            ->update(['status' => 'read']);

        return response()->json(['message' => 'Notifications marked as read']);
    }

    public function removeAllClaimStub(Request $request)
    {
        $userEmail = auth()->user()->email;
    
        ClaimStub::where('email', $userEmail)
            ->update(['status' => 'deleted']);
    
        return response()->json(['success' => 'All claim stub removed successfully!']);
    }
    


  

    
    public function show($shipment_id): JsonResponse
    {
        $claimStub = ClaimStub::where('shipment_id', $shipment_id)->first();
    
        if (!$claimStub) {
            return response()->json(['error' => 'Claim Stub not found'], 404);
        }
    
        $companyDetails = Company::first();  
    
        return response()->json([
            'shipment_id' => $claimStub->shipment_id,
            'fname' => $claimStub->fname,
            'lname' => $claimStub->lname,
            'phone' => $claimStub->phone,
            'email' => $claimStub->email,
            'expected_delivery_date' => $claimStub->expected_delivery_date,
            'company_phone' => $companyDetails->phone ?? 'N/A',
            'company_email' => $companyDetails->email ?? 'N/A'
        ]);
    }
    
}
