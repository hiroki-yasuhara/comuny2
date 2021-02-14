<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Category;
use App\Models\Area;
use App\Models\like;
use Auth;

class CommunityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$communities = Community::all();
        //$communities = \DB::table('communities')
        $communities = Community::select('communities.id as id','communities.community_name','communities.image',
        'communities.content','categories.id as ca_id','categories.category','areas.id as ar_id','areas.area')
        ->join('categories','communities.category_id','=','categories.id')
        ->leftjoin('areas','communities.area_id','=','areas.id')->orderBy('communities.id')->get();

        $authId = Auth::id();
        $likeCommunities = Like::select('likes.community_id as id','community_name')
        ->join('communities','likes.community_id','=','communities.id')->where('likes.user_id','=',$authId)
        ->orderBy('likes.community_id')->get();
        return view('community/index',compact('communities','likeCommunities'));
        //return view("community/index");
    }
    public function show($id)
    {
        $community = Community::findOrFail($id);
        $category_id_loop = $this->category_pulldown();
        $area_id_loop = $this->area_pulldown();
        $authUser = Auth::user(); 
        $like = $community->likes()->where('user_id', Auth::user()->id)->first();
        return view('community/show',compact('community','category_id_loop','area_id_loop','like'));
    }

    public function create()
    {
        // 空の$bookを渡す
        $community = new Community();
        //$categories = Category::select('id', 'category')->get();
        // key,value ペアに直す
        //$category_id_loop = $categories->pluck('category','id');
        $category_id_loop = $this->category_pulldown();
        $area_id_loop = $this->area_pulldown();
        return view('communityregister/create', compact('community','category_id_loop','area_id_loop'));
    }
    
    public function store(Request $request)
    {
        //eval(\Psy\sh());
        //extract(\Psy\Shell::debug(get_defined_vars()));
        $community = new Community();
        $community->community_name = $request->community_name;
        $originalImg= $request->image;
        //if($originalImg->isValid()) {
            $filePath = $originalImg->store('public');
            $community->image = str_replace('public/', '', $filePath);
        //}
        //$community->community_name = $request->community_name;

        $community->category_id = $request->category_id;
        $community->area_id = $request->area_id;
        //$community->image = $request->image;
        $community->content = $request->content;
        $community->administrator = Auth::user()->id;;
        $community->save();
    
        return redirect("communityregister/index");
    }

    public function edit($id)
    {
        $community = Community::findOrFail($id);
        $category_id_loop = $this->category_pulldown();
        $area_id_loop = $this->area_pulldown();
        //$categories = Category::select('id', 'category')->get();
        // key,value ペアに直す
        //$category_id_loop = $categories->pluck('category','id');
        $authUser = Auth::user(); 
        $like = $community->likes()->where('user_id', Auth::user()->id)->first();
        return view('communityregister/edit',compact('community','category_id_loop','area_id_loop','like'));
    }

    public function update(Request $request, $id)
    {
        //extract(\Psy\Shell::debug(get_defined_vars()));
        $community  = Community::findOrFail($id);
        $community->community_name = $request->community_name;
        $originalImg= $request->image;
        //if($originalImg->isValid()) {
            $filePath = $originalImg->store('public');
            $community->image = str_replace('public/', '', $filePath);
        $community->category_id = $request->category_id;
        $community->area_id = $request->area_id;
        $community->content = $request->content;
        $community->save();

        return redirect("communityregister/index");
    }

    public function destroy($id)
    {
        $community = Community::findOrFail($id);
        $community->delete();

        return redirect("communityregister/index");
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
