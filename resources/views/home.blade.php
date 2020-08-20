@extends('layouts.container3')

@section('slider')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="border: 1px solid #cccccc; margin-bottom: 10px">
        <ol class="carousel-indicators">
            @for($i = 0; $i < count($slider); $i++)
                @if($i == 0)
                    <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="active"></li>
                @else
                    <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
                @endif
            @endfor
        </ol>
        <div class="carousel-inner">
            <?php $s = 0; ?>
            @foreach($slider as $image)
                <div class="item @if($s == 0) active @endif">
                    <a href="{{ $image->url }}" title="{{ $image->slogan }}">
                        <img src="{{ url('/upload/'.$image->image) }}" >
                    </a>
                </div>
                <?php $s++; ?>
            @endforeach
        </div>
        <div class="carousel-slogan"></div>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
@endsection

@section('content')
	<div class="content-page">
    <h3>{{ $page->title }}</h3>
    {!! $page->content !!}
    @if(count($news) > 0)
        <h4 style="color: royalblue" ><i class="fa fa-newspaper-o" aria-hidden="true"></i> Новости</h4>
        <div style="background-color: #f2f2f2; padding: 10px">
        @foreach($news as $new)
            <div>
                <a href="/news/{{ $new->id }}">{{ $new->title }}</a></br>
            <span style="float: right; font-weight: normal; color: orangered; font-size: 12px; margin-top: -20px">[ {{ date('d.m.Y', strtotime($new->published_at))}} ]</span>
                @if($new->image)
                    <img class="news_image_list" src="{{ url('/upload/'.$new->image) }}">
                @endif
                {!! \Illuminate\Support\Str::words($new->content, 50) !!}
                <a href="{{ url('/news/'.$new->id) }}">подробнее</a>
				<div class="clear"></div><br>
            </div>
        @endforeach
            </div>
    @endif
	</div>
@endsection
