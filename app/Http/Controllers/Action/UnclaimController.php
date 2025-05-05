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
use App\Models\UnclaimShipment;

class UnclaimController extends Controller
{
    public function unclaim_shipment(HttpRequest $request)  
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
                UnclaimShipment::create($shipment->toArray());

                $existingNotification = Notification::where('email', $shipment->email)
                    ->where('message', "Your shipment number {$shipment->shipment_id} was not claimed by your receiver.")
                    ->exists();

                if (!$existingNotification) {
                    Notification::create([
                        'email' => $shipment->email,
                        'message' => "Your shipment number {$shipment->shipment_id} was not claimed by your receiver."
                    ]);
                }

                $shipment->delete();
            }

            return redirect()->route('teller.pages.dispatched')->with('success', 'Shipment Unclaimed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_alert', 'An error occurred while submitting shipments.');
        }
    }

    public function index_unclaim()
    {
        $shipments = DB::table('unclaim_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('teller.pages.unclaimed', compact('shipments'));
    }

    public function show_unclaim($id)
    {
        $shipment = UnclaimShipment::where('shipment_id', $id)->get();
        return view('teller.pages.details.unclaimed', compact('shipment'));
    }

    public function index_unclaim_admin()
    {
        $shipments = DB::table('unclaim_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('admin.pages.shipments.unclaim', compact('shipments'));
    }

    public function show_unclaim_admin($id)
    {
        $shipment = UnclaimShipment::where('shipment_id', $id)->get();
        return view('admin.pages.shipments.details.unclaim', compact('shipment'));
    }

    public function index_unclaim_user()
    {
        $shipments = DB::table('unclaim_shipment')
        ->select('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
        ->groupBy('shipment_id', 'fname', 'lname', 'phone', 'email', 'street', 
                'brgy', 'city', 'province', 'zipcode', 'region', 'origin', 'destination', 'dispatch_date', 'arrival_date')
        ->orderByDesc('id', 'desc')
        ->paginate(20);

        return view('customer.pages.shipment.unclaim', compact('shipments'));
    }

    public function show_unclaim_user($id)
    {
        $shipment = UnclaimShipment::where('shipment_id', $id)->get();
        return view('customer.pages.shipment.details.unclaim', compact('shipment'));
    }
}
