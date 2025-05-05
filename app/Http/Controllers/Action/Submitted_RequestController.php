<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;  
use App\Models\Request as ShipmentRequest;   
use App\Models\Submitted_Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Submitted_RequestController extends Controller
{
    public function submitShipments(HttpRequest $request)  
    {
        $userIds = $request->input('user_ids');
    
        if (empty($userIds)) {
            return redirect()->back()->with('error_message', 'No User Selected');
        }
    
        $shipments = ShipmentRequest::whereIn('shipment_id', $userIds)->get();
    
        if ($shipments->isEmpty()) {
            return redirect()->back()->with('error_message', 'No matching shipments found.');
        }
    
        try {
            foreach ($shipments as $shipment) {
                Submitted_Request::create($shipment->toArray());
    
                $shipment->delete();
            }
    
            return redirect()->route('teller.pages.request')->with('success', 'Request Successfully Submitted to Admin.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An error occurred while sending shipments.');
        }
    }



    public function index()
    {
        $shipments = DB::table('submitted_request')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('admin.pages.shipments.submitted_request', compact('shipments'));
    }

    public function show($id)
    {
        $shipment = Submitted_Request::where('shipment_id', $id)->get();
        return view('admin.pages.shipments.details.submitted_request', compact('shipment'));
    }
    
}
