<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    public $asYouType = true;

    public function toSearchableArray(){
        return $this->only(['title', 'content']);
    }
}
