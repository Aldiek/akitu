<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use \App\Models\Message;
class ChatInboxController extends Controller
{
   
    public function index() {
        // Show just the users and not the admins as well
        $users = User::where('utype', 'USR')->where('department', auth()->user()->department )->orderBy('id', 'DESC')->get();

        if (auth()->user()->utype === 'USR') {
            $messages = Message::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        }

        return view('chat.home', [
            'users' => $users,
            'messages' => $messages ?? null
        ]);
    }

    public function show($id) {
        $usr=User::find($id);


        if (auth()->user()->utype === 'ADM' && auth()->user()->department === $usr->department && $usr->utype === 'USR') {
             $sender = User::findOrFail($id);

        $users = User::with(['message' => function($query) {
            return $query->orderBy('created_at', 'DESC');
        }])->where('utype', 'USR')
            ->orderBy('id', 'DESC')
            ->get();

        if (auth()->user()->utype === 'USR') {
            $messages = Message::where('user_id', auth()->id())->orWhere('receiver', auth()->id())->orderBy('id', 'DESC')->get();
        } 
            else if ($usr->utype == null || $usr->department == null ){
            abort(404);
        }
            else {
            $messages = Message::where('user_id', $sender)->orWhere('receiver', $sender)->orderBy('id', 'DESC')->get();
        }

        return view('chat.show', [
            'users' => $users,
            'messages' => $messages,
            'sender' => $sender,
        ]);
        }
        else {
           abort(404);
        }

       
    }

}
