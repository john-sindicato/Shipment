<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Submitted_Request;
use App\Models\DeclinedRequest;
use App\Models\Notification;

class Declined_RequestController extends Controller
{
    public function declineShipments(Request $request)
    {
        $userIds = json_decode($request->input('user_ids'), true); 
        $declineReason = $request->input('decline_reason');
    
        if (empty($userIds)) {
            return redirect()->back()->with('error_message', 'No User Selected');
        }
    
        if (empty($declineReason)) {
            return redirect()->back()->with('error_message', 'Please enter a decline reason.');
        }
    
        $shipments = Submitted_Request::whereIn('shipment_id', $userIds)->get();
    
        if ($shipments->isEmpty()) {
            return redirect()->back()->with('error_message', 'No matching shipments found.');
        }
    
        try {
            foreach ($shipments as $shipment) {
                DeclinedRequest::create([
                    'shipment_id' => $shipment->shipment_id,
                    'fname' => $shipment->fname,
                    'lname' => $shipment->lname,
                    'phone' => $shipment->phone,
                    'email' => $shipment->email,
                    'street' => $shipment->street,
                    'brgy' => $shipment->brgy,
                    'city' => $shipment->city,
                    'province' => $shipment->province,
                    'zipcode' => $shipment->zipcode,
                    'region' => $shipment->region,
                    'origin' => $shipment->origin,
                    'destination' => $shipment->destination,
                    'category' => $shipment->category,
                    'length' => $shipment->length,
                    'width' => $shipment->width,
                    'height' => $shipment->height,
                    'weight' => $shipment->weight,
                    'decline_reason' => $declineReason,
                    'decline_date' => now()
                ]);
    
                $existingNotification = Notification::where('email', $shipment->email)
                                              ->where('message', "Your shipment number {$shipment->shipment_id} has been declined. <br /> Reason: {$declineReason}")
                                              ->exists();
    
                if (!$existingNotification) {
                    Notification::create([
                        'email' => $shipment->email,
                        'message' => "Your shipment number {$shipment->shipment_id} has been declined. <br /> Reason: {$declineReason}"
                    ]);
                }
    
                $shipment->delete();
            }
    
            return redirect()->route('admin.pages.shipments.submitted_request')
                             ->with('success', 'Shipment successfully declined.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An error occurred while processing the shipments.');
        }
    }
    
    

    public function index()
    {
        $shipments = DB::table('declined_request')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'decline_reason', 'decline_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'decline_reason', 'decline_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('teller.pages.declined', compact('shipments'));
    }

    public function show($id)
    {
        $shipment = DeclinedRequest::where('shipment_id', $id)->get();
        return view('teller.pages.details.declined', compact('shipment'));
    }

}
