<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ActRepair extends Model
{
    use Notifiable;

    protected $table = 'act_repairs';

    public function status_repair(){
        return $this->belongsTo('App\StatusRepairs');
    }

    public function user_consent(){
        return $this->belongsTo('App\UserConsent');
    }

    public function is_open(){
        if($this->status_repair_id == 3 || $this->status_repair_id == 2){
            return true;
        }
        return false;
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function routeNotificationForMail(){
        return $this->order->user->email;
    }
}
