<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class post extends Model
{

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function catagories(){
    return $this->belongsToMany('App\Catagory')->withTimestamps();
  }
  public function tags(){
    return $this->belongsToMany('App\Tag')->withTimestamps();
  }
  public function favourite_to_users(){
    return $this->belongsToMany('App\user')->withTimestamps();
  }

  public function comments(){
    return $this->hasMany('App\Comment');
  }

  public function scopeApproved($query)
   {
       return $query->where('is_aproved', 1);
   }
   public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
