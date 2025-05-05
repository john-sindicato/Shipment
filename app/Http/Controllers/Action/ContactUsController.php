<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller; 
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactUsController extends Controller
{
    public function contact_us(Request $request)
    {
        $request->validate([
            'fname'   => 'required|string|max:255',
            'lname'   => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        ContactUs::create([
            'fname'   => $request->input('fname'),
            'lname'   => $request->input('lname'),
            'phone'   => $request->input('phone'),
            'email'   => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }



    public function getMessages()
    {
        $messages = ContactUs::orderBy('created_at', 'desc')
            ->select('id', 'fname', 'lname', 'phone', 'email', 'message', 'status', 'created_at')
            ->where('status', '!=', 'deleted')   
            ->get();
    
        return response()->json($messages);
    }    
    
    public function markAsRead1()
    {
        ContactUs::where('status', 'new')->update(['status' => 'read']);
    
        return response()->json(['message' => 'Messages marked as read']);
    }
    
    public function removeAllMessages()
    {
        try {
            ContactUs::where('status', '<>', 'deleted')->update(['status' => 'deleted']);
    
            return response()->json(['success' => 'All messages removed successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
    
    

    public function getMessage($id)
    {
        $message = ContactUs::find($id);

        if ($message) {
            return response()->json(['success1' => true, 'message' => $message]);
        } else {
            return response()->json(['success1' => false, 'error' => 'Message not found']);
        }
    }

   
public function sendReply(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'name' => 'required|string',
        'message' => 'nullable|string', // allow empty string
        'id' => 'required|integer',
    ]);

    $contact = ContactUs::find($request->id);

    $data = [
        'name' => $request->name,
        'replyMessage' => $request->message,
        'customerMessage' => $contact ? $contact->message : '',
    ];

    Mail::send('email.reply', $data, function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Reply from Navi Cargo Support Team')
                ->from('johnlloydabellanosa0@gmail.com', 'Navi Cargo');
    }); 

    if ($contact) {
        $contact->reply = $request->message; // Save the reply, even if empty
        $contact->status = 'replied';
        $contact->save();
    }

    return response()->json(['success1' => 'Reply sent successfully!']);
}


}

