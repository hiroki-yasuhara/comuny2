<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CommunityChatController extends Controller
{
    public function index()
    {
        return view('community_chat/index');
    }
    public function index2(Request $request,$id)
    {   
        session()->put(['community_id'=>$id]);
        return view('community_chat/index');
    }
}
