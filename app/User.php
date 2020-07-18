<?php
namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable
    {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */

        protected $fillable = [
            'role_id','name', 'username','email', 'password',
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];


        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];


        public function role()
        {
          return $this->belongsTo('App\Role');
        }

        public function posts(){
          return $this->hasMany('App\post');
        }
        public function favorite_to_post(){
          return $this->belongsToMany('App\post')->withTimestamps();
        }

        public function comments(){
          return $this->hasMany('App\Comment');
        }
      public function scopeAuthors($query){
        return $query->where('role_id',2);
      }

}
