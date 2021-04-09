<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\MessageCreated;
use Auth;

class ChatController extends Controller
{
    public function index() {// 新着順にメッセージ一覧を取得
        $id =session()->get('community_id');
        eval(\Psy\sh());
        return Chat::where('community_id',$id)->orderBy('id', 'asc')->get();
        //return Chat::paginate(10)->get();
        //return Chat::orderBy('id', 'desc')->get();
    
    }
    
    public function create(Request $request) { // メッセージを登録
        $id =session()->get('community_id');
        $authId = Auth::id();
        $message = Chat::create([
            'message' => $request->message,
            'community_id' =>$id,
            'user_id' =>$authId

        ]);
        event(new MessageCreated($message));
    
    }
}
