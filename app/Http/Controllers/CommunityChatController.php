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
}
