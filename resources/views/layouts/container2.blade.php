@extends('layouts.app')
@section('container')
    <div class="col-sm-12 col-md-10 col-lg-10">
        @include('layouts.bannerTop')
        @include('layouts.message')
        @yield('content')
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2 right_panel">
        <div class="row">
            @include('layouts.map')
            @if(\App\Banner::find(3)->active == 1)
                <div class="banner">{!! \App\Banner::find(3)->banner !!}</div>
            @endif
        </div>
    </div>
    <div class="clear"></div>
@endsection