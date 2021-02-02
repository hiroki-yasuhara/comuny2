<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Community extends Model
{
    use HasFactory;

    public function likes()
    {
      return $this->hasMany('App\Models\Like');
    }
    public function like_by()
    {
      return Like::where('user_id', Auth::user()->id)->first();
    }
}
