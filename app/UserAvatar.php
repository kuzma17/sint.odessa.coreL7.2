<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAvatar extends Model
{
    protected $table = 'user_avatars';

    protected $fillable = [
        'user_id', 'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
