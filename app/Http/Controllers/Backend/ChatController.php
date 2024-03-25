<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ChatMessage; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; 

class ChatController extends Controller
{
    public function SendMessage(Request $request){

        $request->validate([
            'msg' => 'required'
        ]);

        ChatMessage::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'msg' => $request->msg,
            'created_at' => Carbon::now(),
            'read_status' => 0,
        ]);

        return response()->json(['message' => 'Message Send Successfully']);

    }

    public function SendMessageToInstructor(Request $request){

      
        $request->validate([
            'msg' => 'required'
        ]);

        $instructor = User::find($request->receiver_id);

        ChatMessage::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'msg' => $request->msg,
            'created_at' => Carbon::now(),
            'read_status' => 0,
        ]);

        $notification = array(

            'message' => "You started a chat with $instructor->name",
            'alert-type' => 'success'

        );
        
        return redirect()->route('live.Node.chat')->with($notification);

    }

    public function GetAllUsers(){

        $chats = ChatMessage::orderBy('id','DESC')
                ->where('sender_id',auth()->id())
                ->orWhere('receiver_id',auth()->id())
                ->get();
                $currentUser = auth()->user();
                $users = $chats->flatMap(function($chat){
                    if ($chat->sender_id === auth()->id()) {
                       return [$chat->serder, $chat->receiver];
                    }
                    return [$chat->receiver, $chat->serder];
                })->unique();       
        
                return response()->json([
                    
                    'users' => $users,
                    'currentUser' => $currentUser,
                ]);

    }

    public function UserMsgById($userId){

        $user = User::find($userId);

        if ($user) {
           $messages = ChatMessage::where(function($q) use ($userId){
                     $q->where('sender_id',auth()->id());
                     $q->where('receiver_id',$userId);
                     })->orWhere(function($q) use ($userId){
                        $q->where('sender_id',$userId);
                        $q->where('receiver_id',auth()->id());
                     })->with('user')->get();

                     return response()->json([
                        'user' => $user,
                        'messages' => $messages, 
                     ]);
        }else {
            return response()->json([
                'message' => 'User not found',
                'user' => null,
                'messages' => [],
            ]);
        }

    }

    public function LiveChat(){
        $currentUser = auth()->user();
        return view('instructor.chat.live_chat',compact('currentUser'));
    }

    public function ChatTest(){
        return view('frontend.testchat');
    }

    public function ChatNode(){
        $currentUser = auth()->user();
        return view('instructor.chat.live_chat_node',compact('currentUser')); 
    }

    public function GetUserMessageCount(){
        $currentUserID = Auth::User();
        $findSenderCount = ChatMessage::select('sender_id', \DB::raw('count(*) as totalMessCount'))
        ->where('receiver_id', $currentUserID->id)
        ->where('read_status', 0)
        ->groupBy('sender_id')
        ->get();     

        if($findSenderCount !== null && count($findSenderCount) > 0) {
            // Query returned data
            // You can continue processing the data here
            return response()->json(['sender' => $findSenderCount]);
        } else {
            // Query returned empty data
            // You can handle this case here
            // For example, return a message or perform some action
            return response()->json(['sender' => 0 ]);
        }
    }

    public function DelSenderMessage($selectUserID){
        $currentUserID = Auth::User();

        $affectedRows = ChatMessage::where('receiver_id', $currentUserID->id)
        ->where('sender_id', $selectUserID)
        ->update(['read_status' => 1]);

        if ($affectedRows > 0) {
            // Update operation was successful
            
            return response()->json(['Dbmessage' => "Update successful: $affectedRows rows updated."]);
        } else {
            // No rows were updated

            return response()->json(['Dbmessage' => "No rows updated."]);
        }

    }

}
