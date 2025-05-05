<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 
use App\Models\DispatchedShipment;
use App\Models\Notification;
use App\Models\ClaimedShipment;

class ClaimedController extends Controller
{
    public function claim_shipment(HttpRequest $request)  
    {
        $userIds = $request->input('user_ids');

        // Ensure $userIds is always an array
        if (is_string($userIds)) {
            $userIds = array_filter(explode(',', $userIds));
        }

        if (empty($userIds) || count($userIds) === 0) {
            return redirect()->back()->with('error_alert', 'No User Selected');
        }

        $shipments = DispatchedShipment::whereIn('shipment_id', $userIds)->get();

        if ($shipments->isEmpty()) {
            return redirect()->back()->with('error_alert', 'No matching shipments found.');
        }

        try {
            foreach ($shipments as $shipment) {
                ClaimedShipment::create($shipment->toArray());

                $existingNotification = Notification::where('email', $shipment->email)
                    ->where('message', "Your receiver has successfully claimed shipment number {$shipment->shipment_id}. ")
                    ->exists();

                if (!$existingNotification) {
                    Notification::create([
                        'email' => $shipment->email,
                        'message' => "Your receiver has successfully claimed shipment number {$shipment->shipment_id}."
                    ]);
                }

                $shipment->delete();
            }

            return redirect()->route('teller.pages.dispatched')->with('success', 'Shipment Claimed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_alert', 'An error occurred while submitting shipments.');
        }
    }


    public function index_claim()
    {
        $shipments = DB::table('claimed_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date', 'claimed_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date', 'claimed_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('teller.pages.claimed', compact('shipments'));
    }

    public function show_claim($id)
    {
        $shipment = ClaimedShipment::where('shipment_id', $id)->get();
        return view('teller.pages.details.claimed', compact('shipment'));
    }

    public function index_claim_admin()
    {
        $shipments = DB::table('claimed_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date', 'claimed_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date', 'claimed_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('admin.pages.shipments.claimed', compact('shipments'));
    }

    public function show_claim_admin($id)
    {
        $shipment = ClaimedShipment::where('shipment_id', $id)->get();
        return view('admin.pages.shipments.details.claimed', compact('shipment'));
    }

    public function index_claim_user()
    {
        $shipments = DB::table('claimed_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date', 'claimed_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date', 'claimed_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('customer.pages.shipment.claimed', compact('shipments'));
    }

    public function show_claim_user($id)
    {
        $shipment = ClaimedShipment::where('shipment_id', $id)->get();
        return view('customer.pages.shipment.details.claimed', compact('shipment'));
    }
}
