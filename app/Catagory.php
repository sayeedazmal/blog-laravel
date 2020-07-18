<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
  public function posts(){
    return $this->belongsToMany('App\post')->withTimestamps();
  }
}
