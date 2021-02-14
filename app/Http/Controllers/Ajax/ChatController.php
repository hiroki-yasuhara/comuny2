<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Events\MessageCreated;

class ChatController extends Controller
{
    public function index() {// 新着順にメッセージ一覧を取得

        return Chat::orderBy('id', 'desc')->get();
    
    }
    
    public function create(Request $request) { // メッセージを登録
        $message = Chat::create([
            'message' => $request->message,
            'community_id' =>'1',
            'user_id' =>'1'

        ]);
        event(new MessageCreated($message));
    
    }
}
