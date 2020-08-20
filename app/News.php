<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class News extends Model
{
    use Searchable;
    public $asYouType = true;
    protected $table = 'news';

    public function toSearchableArray(){
        return $this->only(['title', 'content']);
    }

    public static function count(){
        return Settings::find(1)->count_news;
    }

}
