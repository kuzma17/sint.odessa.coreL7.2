<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use ModelTree, AdminBuilder;

    protected $table = 'menus';

    public function __construct(array $attributes = []) // For Tree in admin
    {
        parent::__construct($attributes);
        $this->setOrderColumn('weight');
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeOrder($query){
        return $query->orderBy('parent_id')
            ->orderBy('weight');
    }

    public function scopeRoot($query){
        return $query->where('parent_id', 0);
    }

    public static function buildTree($items){
        $grouped = $items->groupBy('parent_id');
        foreach ($items as $item) {
            if ($grouped->has($item->id)) {
                $item->children = $grouped[$item->id];
            }
        }
        return $items->where('parent_id', 0);
    }

    public static function getMenu(){
        $items = self::active()->order()->get();
        return self::buildTree($items);
    }

}
