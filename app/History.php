<?php

namespace App;

use Encore\Admin\Facades\Admin;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';

    protected $fillable = ['order_id', 'user_admin', 'status_info', 'comment'];
}
