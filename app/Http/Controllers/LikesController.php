<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Community;
use Auth;

class LikesController extends Controller
{
    public function store(Request $request, $communityId)
    {
      eval(\Psy\sh());
        Like::create(
          array(
            'user_id' => Auth::user()->id,
            'community_id' => $communityId
          )
        );

        //$Community = Community::findOrFail($communityId);

        return redirect("community/$communityId/show");
    }

    public function destroy($communityId, $likeId) {
      $community = Community::findOrFail($communityId);
      $community->like_by()->findOrFail($likeId)->delete();

      return redirect("community/$communityId/show");
    }
}
