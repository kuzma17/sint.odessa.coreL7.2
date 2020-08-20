@extends('layouts.container2')

@section('content')
	<div class="content-page">
    <h3>{{$news->title}}</h3>
    <span style="float: right; font-weight: normal; color: red; font-size: 13px; margin-top: -30px">[ {{ date('d m Y', strtotime($news->published_at))}} ]</span>
    <div class="news_content">
        @if($news->image)
            <img class="news_image" src="{{ url('/upload/'.$news->image) }}">
        @endif
        {!! $news->content !!}</div>
	</div>
@endsection
