@php
    function buildMenu($menu_items, $level=0){ // recursive function
        echo '<ul class="dropdown-menu submenu_'.$level.'" role="menu">';
        foreach ($menu_items as $item) {
            if (isset($item->children) && count($item->children()->active()->get()) > 0) {
                echo '<li class="dropdown-submenu"><a href="#">'.$item->title.'</a>';
                buildMenu($item->children, $level+1);
                echo '</li>';
            }else{
                echo '<li><a href="'.route("page", ["url"=>$item->url]).'">'.$item->title.'</a></li>';
            }
        }
        echo '</ul>';
    }

//$menu = new \App\Menu();
//$menu_list = $menu->getMenu();

$menu_list = \App\Menu::getMenu();

@endphp
<nav class="navbar navbar-default navbar-inverse" style="margin-top: 10px">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="col-sm-12 col-md-9 collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav">
            @foreach($menu_list as $item)
                @if(isset($item->children) && count($item->children()->active()->get()) > 0)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $item->title }} <span class="caret"></span></a>
                        @php(buildMenu($item->children, 1))
                    </li>
                @else
                    <li class="menu_site @if(Request::path() == $item->url) active_menu @endif">
                        <a href="{{ url($item->url) }}">{{ $item->title }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="col-sm-12 col-md-3 navbar-right ">
        <form class="navbar-form" role="search" method="post" name="search_site" action="{{ url('/search') }}">
            {{ csrf_field() }}
            <div class="input-group" style="margin-left:70px">
                <input type="search" name="search" class="form-control" placeholder="поиск по сайту">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</nav>
<!--
<div class="container">
    <div class="row">
        <h2>Multi level dropdown menu in Bootstrap 3</h2>
        <hr>
        <div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" class="btn btn-primary" data-target="#" href="#">
                Dropdown <span class="caret"></span>
            </a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li><a href="#">Some action</a></li>
                <li><a href="#">Some other action</a></li>
                <li class="divider"></li>
                <li class="dropdown-submenu">
                    <a tabindex="-1" href="#">Hover me for more options</a>
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Second level</a></li>
                        <li class="dropdown-submenu">
                            <a href="#">Even More..</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">3rd level</a></li>
                                <li><a href="#">3rd level</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Second level</a></li>
                        <li><a href="#">Second level</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
-->