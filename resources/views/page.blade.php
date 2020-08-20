@extends('layouts.container2')
@section('content')
    <div class="content-page">
        <h3>{{ $page->title }}</h3>
        {!! $page->content !!}
    </div>
@endsection