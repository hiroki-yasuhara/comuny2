<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['message','user_id','community_id'];

    public function users()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function communities()
    {
      return $this->belongsTo('App\Models\Community');
    }
}
