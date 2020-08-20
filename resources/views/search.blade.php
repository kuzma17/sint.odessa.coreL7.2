@extends('layouts.container3')

@section('content')
    <div class="content-page search_list">
        <h3>Результаты поиска</h3>
        @if(count($results) < 1)
            <p>По запросу: {{ $query }} ничего не найдено. Попробуйте ввести другую поисковую фразу в форму поиска.</p>
        @else
            <p>По запросу: {{ $query }} найдены документы.</p>
            @foreach($results as $result)
                <a href="@if($result->url == 'news' || $result->url == 'post'){{ url($result->url.'/'.$result->id) }}@else{{ url($result->url) }}@endif" >
                    <h5>{{ $result->title }}</h5></a>
                    {!! \Illuminate\Support\Str::words(strip_tags($result->content), 30) !!}
                <a href="@if($result->url == 'news' || $result->url == 'post'){{ url($result->url.'/'.$result->id) }}@else{{ url($result->url) }}@endif" ><h5>Подробнее...</h5></a>
                <div class="clear"></div>
            @endforeach
        @endif
    </div>
@endsection
