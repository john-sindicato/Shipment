<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Models\Submitted_Request;
use App\Models\ApprovedRequest;
use App\Models\Queued;
use App\Models\InTransitShipment;
use App\Models\DispatchedShipment;
use App\Models\CancelledShipment;
use App\Models\DeclinedRequest;
use App\Models\User;
use App\Models\Teller;
use App\Models\Rates;
use App\Models\Branch;
use App\Models\ClaimedShipment;
use App\Models\UnclaimShipment;

class DashboardController extends Controller
{
    public function badge()
    {
        $pending = Request::distinct('shipment_id')->count('shipment_id');
        $approved = ApprovedRequest::distinct('shipment_id')->count('shipment_id');
        $queued = Queued::distinct('shipment_id')->count('shipment_id');
        $inTransitCount = InTransitShipment::distinct('shipment_id')->count('shipment_id');
        $dispatchedCount = DispatchedShipment::distinct('shipment_id')->count('shipment_id');
        $declined = DeclinedRequest::distinct('shipment_id')->count('shipment_id');
        $claimed = ClaimedShipment::distinct('shipment_id')->count('shipment_id');
        $unclaim = UnclaimShipment::distinct('shipment_id')->count('shipment_id');
        
        return view('teller.pages.dashboard', compact('pending', 'approved', 'queued', 'inTransitCount', 'dispatchedCount', 'declined', 'claimed', 'unclaim'));
    }    

    public function badge_admin()
    {
        $request = Submitted_Request::distinct('shipment_id')->count('shipment_id');
        $queued = Queued::distinct('shipment_id')->count('shipment_id');
        $inTransitCount = InTransitShipment::distinct('shipment_id')->count('shipment_id');
        $dispatchedCount = DispatchedShipment::distinct('shipment_id')->count('shipment_id');
        $cancelled = CancelledShipment::distinct('shipment_id')->count('shipment_id');
        $claimed = ClaimedShipment::distinct('shipment_id')->count('shipment_id');
        $unclaim = UnclaimShipment::distinct('shipment_id')->count('shipment_id');

        $tellersCount = Teller::count();
        $usersCount = User::count();

        $openRoutes = Rates::where('status', 'open')->count();
        $closedRoutes = Rates::where('status', 'close')->count();
     
        $openBranches = Branch::where('status', 'open')->count();
        $closedBranches = Branch::where('status', 'close')->count();
        
        return view('admin.pages.dashboard', compact('request', 'queued', 'inTransitCount', 'dispatchedCount', 'cancelled', 'claimed', 'unclaim', 'tellersCount', 'usersCount', 'openRoutes', 'closedRoutes', 'openBranches', 'closedBranches'));
    }    
}

