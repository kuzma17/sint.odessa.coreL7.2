<?php

namespace App\Admin\Extensions;

use App\Order;
use App\User;

class BadgeMenu
{
    public static function countUser(){
        $countUser = User::count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/users"]');
            obj.append( '<span class="label label-success" style="position:absolute; right: 10px" >$countUser</span>' );
EOT;
        return $script;
    }

    public static function countOrder(){
        $countOrder = Order::count();
        $script = <<<EOT
            var obj = $('ul.sidebar-menu li a[href="/admin/orders"]');
            obj.append( '<span class="label label-danger" style="position:absolute; right: 10px" >$countOrder</span>' );
EOT;
        return $script;
    }

}