<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\Category;
use App\Models\Area;
use App\Models\like;
use Auth;

class LikeCommunityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show($id)
    {
        $community = Community::findOrFail($id);
        $category_id_loop = $this->category_pulldown();
        $area_id_loop = $this->area_pulldown();
        $authUser = Auth::user(); 
        $like = $community->likes()->where('user_id', Auth::user()->id)->first();

        $likeUsers = Like::select('likes.user_id as id','name')
        ->join('users','likes.user_id','=','users.id')->where('likes.community_id','=',$id)
        ->orderBy('likes.user_id')->get();
        eval(\Psy\sh());
        return view('likecommunity/show',compact('community','category_id_loop','area_id_loop','like','likeUsers'));
    }

    private function category_pulldown()
    {
        $categories = Category::select('id', 'category')->get();
        // key,value ペアに直す
        $category_id_loop = $categories->pluck('category','id');
        return $category_id_loop;
    }

    private function area_pulldown()
    {
        $areas = Area::select('id', 'area')->get();
        // key,value ペアに直す
        $area_id_loop = $areas->pluck('area','id');
        return $area_id_loop;
    }
}
