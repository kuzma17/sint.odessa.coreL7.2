<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ \App\Settings::first()->title }}</title>
    <meta name="keywords"
          content="{{ \App\Settings::first()->keywords }}@if(isset($page) && $page->keywords != ''), {{ $page->keywords }}@endif">

    <link href="/css/app.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-social.css"/>
    <link rel="stylesheet" href="/css/lightbox.min.css">
    <link href="/css/style.css" rel="stylesheet"/>

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-100689059-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-100689059-1');
    </script>
</head>
<body>
<div class="top-wrapper">
    @include('layouts.menuTop')
</div>

<div class="container">
    <div class="row">
        <div class="rcol-sm-12 col-md-12 col-lg-4">
            <div class="logo"><a href="{{url('/')}}"><img src="/images/logo.jpg"></a></div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4"
             style="padding-top: 10px; padding-left: 0px; color: #808080; font-family: 'Lato', sans-serif; font-size: 12px">
            <div class="clear"></div>
            <div style="float: left; width: 240px"><i class="glyphicon glyphicon-map-marker" style="color: #107fbe"></i>
                Адмиральский пр-т. 33А
            </div>
            <div style="float: left; width: 160px;"><i class="glyphicon glyphicon-earphone"
                                                       style="color: orangered"></i> +38(067)557-65-67
            </div>
            <div class="clear"></div>
            <div style="float: left; width: 240px"><i class="glyphicon glyphicon-map-marker" style="color: #107fbe"></i>
                Соборная пл. 12
            </div>
            <div style="float: left; width: 160px;"><i class="glyphicon glyphicon-earphone"
                                                       style="color: orangered"></i> +38(067)488-04-83
            </div>
            <div class="clear"></div>
            <div style="float: left; width: 240px"><i class="glyphicon glyphicon-map-marker" style="color: #107fbe"></i>
                Днепропетровская дор. 94
            </div>
            <div style="float: left; width: 160px;"><i class="glyphicon glyphicon-earphone"
                                                       style="color: orangered"></i> +38(066)290-50-02
            </div>
            <div class="clear"></div>
            <div style="float: left; width: 240px"><i class="glyphicon glyphicon-map-marker" style="color: #107fbe"></i>
                Ак. Королева 33
            </div>
            <div style="float: left; width: 160px;"><i class="glyphicon glyphicon-earphone"
                                                       style="color: orangered"></i> +38(098)879-30-48
            </div>
            <div class="clear"></div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4" style="padding-top: 15px">
        @if (Auth::guest())
            <!--<a href="{{ url('/user/order-modal') }}" class="btn btn-success btn-top" ><i class="glyphicon glyphicon-plus"></i> Заказать услугу </a>-->
        @else
            <!--<a href="#" class="btn btn-success btn-top" @if(URL::current() != url('/order')) data-toggle="modal" data-target="#orderModal" @endif><i class="glyphicon glyphicon-plus"></i> Сделать заказ </a>-->
            @endif
            <a href="http://sint-market.com" class="btn  btn-warning btn-top" target="_blank"><i
                        class="glyphicon glyphicon-shopping-cart"></i> Перейти в магазин</a>
        </div>
        <div class="clear"></div>
        <div class="container">
        @include('layouts.menu')
        </div>
    </div>

    <div class="clear"></div>
    <div class="container page">
        <div class="row">
            @yield('container')

        </div>
    </div>
</div>


<div class="bottom-wrapper">
    <div class="container bottom">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3 border_right">
                <h4>Контакты</h4>

                <ul class="address-bottom">
                    <li><i class="glyphicon glyphicon-phone"></i> +38(050)392-392-5</li>
                    <li><i class="glyphicon glyphicon-envelope"></i> info@sint.odessa.ua</li>
                    <li><a href="http://sint.odessa.ua"><i class="glyphicon glyphicon-globe"></i> http://sint.odessa.ua</a>
                    </li>
                    <li><a href="http://sint-market.com"><i class="glyphicon glyphicon-shopping-cart"></i>
                            http://sint-market.com</a></li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 border_right">
                <h4>Офисы</h4>

                <ul class="address-bottom">
                    <li><i class="glyphicon glyphicon-map-marker"></i> Гл. офис: Адмиральский пр-т. 33А
                        <i class="glyphicon glyphicon-earphone"></i> +38(0482)333-767
                    </li>
                    <li><i class="glyphicon glyphicon-map-marker"></i> Соборная пл. 12
                        <i class="glyphicon glyphicon-earphone"></i> +38(048)777-16-85
                    </li>
                    <li><i class="glyphicon glyphicon-map-marker"></i> Днепропетровская дор. 94
                        <i class="glyphicon glyphicon-earphone"></i> +38(0482)379-141
                    </li>
                    <li><i class="glyphicon glyphicon-map-marker"></i> Ак. Королева 33
                        <i class="glyphicon glyphicon-earphone"></i> +38(0482)323-505
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3 border_right">
                <h4>Навигация</h4>
                <?php
                $menu = \App\Menu::root()->active()->order()->get();
                $i = 0;
                ?>
                <ul class="menu-bottom">
                    @foreach($menu as $link)
                        @if($i == 5)
                </ul>
                <ul class="menu-bottom">
                    @endif
                    <li><a href="{{ $link->url }}">{{ $link->title }}</a></li>
                    <?php $i++; ?>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2">
                <div class="banner-bottom">
                    <div class="clear"></div>
                    <!--<h4>Мы в соцсетях</h4>
                    <script type="text/javascript">(function(w,doc) {
                            if (!w.__utlWdgt ) {
                                w.__utlWdgt = true;
                                var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
                                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
                                var h=d[g]('body')[0];
                                h.appendChild(s);
                            }})(window,document);
                    </script>
                    <div data-background-alpha="1.0" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-size="12" data-top-button="false" data-share-counter-type="disable" data-share-style="1" data-mode="share" data-like-text-enable="false" data-hover-effect="rotate-cw" data-mobile-view="true" data-icon-color="#ffffff" data-orientation="horizontal" data-text-color="#000000" data-share-shape="round" data-sn-ids="vk.tw.fb.ok." data-share-size="40" data-background-color="#33363b" data-preview-mobile="false" data-mobile-sn-ids="fb.vk.tw.wh.ok.vb." data-pid="1612300" data-counter-background-alpha="1.0" data-following-enable="false" data-exclude-show-more="true" data-selection-enable="false" class="uptolike-buttons" ></div>
                    -->
                    <h4></h4>
                    <!--LiveInternet counter-->
                    <script type="text/javascript"><!--
                        document.write("<a href='http://www.liveinternet.ru/click' " +
                                "target=_blank><img src='http://counter.yadro.ru/hit?t14.11;r" +
                                escape(document.referrer) + ((typeof(screen) == "undefined") ? "" :
                                ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
                                        screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
                                ";" + Math.random() +
                                "' alt='' title='LiveInternet: показано число просмотров за 24" +
                                " часа, посетителей за 24 часа и за сегодня' " +
                                "border=0 width=88 height=31><\/a>")//--></script><!--/LiveInternet-->

                    <!-- I.UA counter --><a href="http://www.i.ua/" target="_blank"
                                            onclick="this.href='http://i.ua/r.php?198771';" title="Rated by I.UA">
                        <script type="text/javascript"><!--
                            iS = 'http' + (window.location.protocol == 'https:' ? 's' : '') +
                                    '://r.i.ua/s?u198771&p104&n' + Math.random();
                            iD = document;
                            if (!iD.cookie)iD.cookie = "b=b; path=/";
                            if (iD.cookie)iS += '&c1';
                            iS += '&d' + (screen.colorDepth ? screen.colorDepth : screen.pixelDepth)
                                    + "&w" + screen.width + '&h' + screen.height;
                            iT = iR = iD.referrer.replace(iP = /^[a-z]*:\/\//, '');
                            iH = window.location.href.replace(iP, '');
                            ((iI = iT.indexOf('/')) != -1) ? (iT = iT.substring(0, iI)) : (iI = iT.length);
                            if (iT != iH.substring(0, iI))iS += '&f' + escape(iR);
                            iS += '&r' + escape(iH);
                            iD.write('<img src="' + iS + '" border="0" width="88" height="31" />');
                            //--></script>
                    </a><!-- End of I.UA counter -->
                    <!-- begin of Top100 code -->

                    <script id="top100Counter" type="text/javascript"
                            src="http://counter.rambler.ru/top100.jcn?3145247"></script>
                    <noscript>
                        <a href="http://top100.rambler.ru/navi/3145247/">
                            <img src="http://counter.rambler.ru/top100.cnt?3145247" alt="Rambler's Top100" border="0"/>
                        </a>

                    </noscript>
                    <!-- end of Top100 code -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright-wrapper">
    <div class="container">
        <div class="copyright">Copyright 2017 @ Designed by <a href="mailto:v.kuzma@mail.ru">Kuzma</a></div>
    </div>
</div>

@include('order.orderModal')

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/lightbox.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
@if(URL::current() == url('/user/order-modal'))
    <script type="text/javascript">
        $('#orderModal').modal('show');
    </script>
@endif

<!--<script type="text/javascript">
    imageDir = "http://mvcreative.ru/example/6/2/snow/";
    sflakesMax = 65;
    sflakesMaxActive = 65;
    svMaxX = 2;
    svMaxY = 6;
    ssnowStick = 1;
    ssnowCollect = 0;
    sfollowMouse = 1;
    sflakeBottom = 0;
    susePNG = 1;
    sflakeTypes = 5;
    sflakeWidth = 15;
    sflakeHeight = 15;
</script>
<script type="text/javascript" src="http://mvcreative.ru/example/6/2/snow.js"></script>
-->
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'zu8O4tOtH7';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->
</body>
</html>
