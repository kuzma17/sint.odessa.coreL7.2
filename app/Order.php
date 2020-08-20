<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    public function type_order(){
        return $this->belongsTo('App\TypeOrder');
    }

    public function type_client(){
        return $this->belongsTo('App\TypeClient');
    }

    public function type_payment(){
        return $this->belongsTo('App\TypePayment');
    }

    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function act_repair(){
        return $this->hasOne('App\ActRepair');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function routeNotificationForMail(){
        return $this->user->email;
    }

    public function history(){
        return $this->hasMany(History::class);
    }
}
