@if(\App\Banner::find(1)->active == 1)
    <div class="banner">{!! \App\Banner::find(1)->banner !!}</div>
@endif