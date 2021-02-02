<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public function users()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function communities()
    {
      return $this->belongsTo('App\Models\Community');
    }

    protected $fillable = ['user_id','community_id'];
}
