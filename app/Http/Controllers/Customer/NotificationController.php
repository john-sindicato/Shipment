<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $userEmail = auth()->user()->email;
    
        $notifications = Notification::where('email', $userEmail)
            ->orderBy('created_at', 'desc')
            ->get();
    
        return response()->json($notifications);
    }
    

    public function markAsRead()
    {
        $userEmail = auth()->user()->email;

        Notification::where('email', $userEmail)
            ->where('status', 'new')
            ->update(['status' => 'read']);

        return response()->json(['message' => 'Notifications marked as read']);
    }

    public function removeAllNotifications(Request $request)
    {
        $userEmail = auth()->user()->email;
     
        Notification::where('email', $userEmail)->delete();
    
        return response()->json(['success' => 'All notifications removed successfully!']);  
    }    
}
