<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'role_user';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function avatar(){
        return $this->user->avatar();
    }
}
