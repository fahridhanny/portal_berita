@extends('index')

@section('content')
<style>
    .swiper-button-next,
    .swiper-button-prev {
        background-color: white;
        background-color: rgba(255, 255, 255, 0.5);
        right:10px;
        padding: 30px;
        color: #000 !important;
        fill: black !important;
        stroke: black !important;
    }
</style>
<!-- Top News Start-->
<div class="top-news">
    <div class="container">
        <div class="row">
            @php
                $banners = App\Banner::all();
            @endphp
            <div class="col-md-6 tn-left swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <div class="tn-img">
                            <img src="{{ url('images/banner/'.$banner->image) }}" height="330px" width="265px"/>
                            <div class="tn-title">
                                <a href="#">{{ $banner->judul }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="col-md-6 tn-right">
                @php
                    $contents_sport = App\Content::where('id_category', 1)->orderby('id', 'DESC')->first();
                    $contents_tech = App\Content::where('id_category', 2)->orderby('id', 'DESC')->first();
                    $contents_bisnis = App\Content::where('id_category', 3)->orderby('id', 'DESC')->first();
                    $contents_hiburan = App\Content::where('id_category', 4)->orderby('id', 'DESC')->first();
                @endphp
                <div class="row">
                    <div class="col-md-6">
                        <div class="tn-img">
                            <img src="{{ url('images/'.$contents_sport->image) }}" height="165px" width="265px"/>
                            <div class="tn-title">
                                @if (app()->getLocale() == 'id')
                                <a href="/id/berita/{{ $contents_sport->title }}" style="font-size: 14px;">
                                    {{ $contents_sport->judul }}
                                </a>
                                @else
                                <a href="/en/news/{{ $contents_sport->title_en }}" style="font-size: 14px;">
                                    {{ $contents_sport->judul_en }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tn-img">
                            <img src="{{ url('images/'.$contents_tech->image) }}" height="165px" width="265px"/>
                            <div class="tn-title">
                                @if (app()->getLocale() == 'id')
                                <a href="/id/berita/{{ $contents_tech->title }}" style="font-size: 14px;">
                                    {{ $contents_tech->judul }}
                                </a>
                                @else
                                <a href="/en/news/{{ $contents_tech->title_en }}" style="font-size: 14px;">
                                    {{ $contents_tech->judul_en }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tn-img">
                            <img src="{{ url('images/'.$contents_bisnis->image) }}" height="165px" width="265px"/>
                            <div class="tn-title">
                                @if (app()->getLocale() == 'id')
                                <a href="/id/berita/{{ $contents_bisnis->title }}" style="font-size: 14px;">
                                    {{ $contents_bisnis->judul }}
                                </a>
                                @else
                                <a href="/en/news/{{ $contents_bisnis->title_en }}" style="font-size: 14px;">
                                    {{ $contents_bisnis->judul_en }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tn-img">
                            <img src="{{ url('images/'.$contents_hiburan->image) }}" height="165px" width="265px"/>
                            <div class="tn-title">
                                @if (app()->getLocale() == 'id')
                                <a href="/id/berita/{{ $contents_hiburan->title }}" style="font-size: 14px;">
                                    {{ $contents_hiburan->judul }}
                                </a>
                                @else
                                <a href="/en/news/{{ $contents_hiburan->title_en }}" style="font-size: 14px;">
                                    {{ $contents_hiburan->judul_en }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top News End-->

<!-- Category News Start-->
<div class="cat-news">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @php
                    $contents = App\Content::where('id_category', 1)->paginate(2);
                    $category = App\Category::where('id', 1)->first();
                @endphp
                <h2>@if(app()->getLocale() == 'id') {{ $category->category }} @else {{ $category->category_en }} @endif</h2>
                <div class="row">
                    @foreach ($contents as $content)
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ url('images/'.$content->image) }}" height="165px" width="265px"/>
                                <div class="cn-title">
                                    @if (app()->getLocale() == 'id')
                                    <a href="/id/berita/{{ $content->title }}" style="font-size: 14px;">
                                        {{ $content->judul }}
                                    </a>
                                    @else
                                    <a href="/en/news/{{ $content->title_en }}" style="font-size: 14px;">
                                        {{ $content->judul_en }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                @php
                    $contents = App\Content::where('id_category', 2)->paginate(2);
                    $category = App\Category::where('id', 2)->first();
                @endphp
                <h2>@if(app()->getLocale() == 'id') {{ $category->category }} @else {{ $category->category_en }} @endif</h2>
                <div class="row">
                    @foreach ($contents as $content)
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ url('images/'.$content->image) }}" height="165px" width="265px"/>
                                <div class="cn-title">
                                    @if (app()->getLocale() == 'id')
                                    <a href="/id/berita/{{ $content->title }}" style="font-size: 14px;">
                                        {{ $content->judul }}
                                    </a>
                                    @else
                                    <a href="/en/news/{{ $content->title_en }}" style="font-size: 14px;">
                                        {{ $content->judul_en }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category News End-->

<!-- Category News Start-->
<div class="cat-news">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @php
                    $contents = App\Content::where('id_category', 3)->paginate(2);
                    $category = App\Category::where('id', 3)->first();
                @endphp
                <h2>@if(app()->getLocale() == 'id') {{ $category->category }} @else {{ $category->category_en }} @endif</h2>
                <div class="row">
                    @foreach ($contents as $content)
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ url('images/'.$content->image) }}" height="165px" width="265px"/>
                                <div class="cn-title">
                                    @if (app()->getLocale() == 'id')
                                    <a href="/id/berita/{{ $content->title }}" style="font-size: 14px;">
                                        {{ $content->judul }}
                                    </a>
                                    @else
                                    <a href="/en/news/{{ $content->title_en }}" style="font-size: 14px;">
                                        {{ $content->judul_en }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                @php
                    $contents = App\Content::where('id_category', 4)->paginate(2);
                    $category = App\Category::where('id', 4)->first();
                @endphp
                <h2>@if(app()->getLocale() == 'id') {{ $category->category }} @else {{ $category->category_en }} @endif</h2>
                <div class="row">
                    @foreach ($contents as $content)
                        <div class="col-md-6">
                            <div class="cn-img">
                                <img src="{{ url('images/'.$content->image) }}" height="165px" width="265px"/>
                                <div class="cn-title">
                                    @if (app()->getLocale() == 'id')
                                    <a href="/id/berita/{{ $content->title }}" style="font-size: 14px;">
                                        {{ $content->judul }}
                                    </a>
                                    @else
                                    <a href="/en/news/{{ $content->title_en }}" style="font-size: 14px;">
                                        {{ $content->judul_en }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Category News End-->

<!-- Tab News Start-->
<div class="tab-news">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#popular">Popular News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#latest">Latest News</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="popular" class="container tab-pane active">
                        @php
                            $contents = App\Content::orderby('view', 'DESC')->limit(3)->get();
                        @endphp
                        @foreach ($contents as $content)
                        <div class="tn-news">
                            <div class="tn-img">
                                <img src="{{ url('images/'.$content->image) }}" height="115px" width="265px"/>
                            </div>
                            <div class="tn-title">
                                @if (app()->getLocale() == 'id')
                                    <a href="/id/berita/{{ $content->title }}">
                                        {{ $content->judul }}
                                    </a>
                                    @else
                                    <a href="/en/news/{{ $content->title_en }}">
                                        {{ $content->judul_en }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div id="latest" class="container tab-pane fade">
                        @php
                            $contents = App\Content::orderby('id', 'DESC')->limit(3)->get();
                        @endphp
                        @foreach ($contents as $content)
                        <div class="tn-news">
                            <div class="tn-img">
                                <img src="{{ url('images/'.$content->image) }}" height="115px" width="265px"/>
                            </div>
                            <div class="tn-title">
                                @if (app()->getLocale() == 'id')
                                    <a href="/id/berita/{{ $content->title }}">
                                        {{ $content->judul }}
                                    </a>
                                    @else
                                    <a href="/en/news/{{ $content->title_en }}">
                                        {{ $content->judul_en }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#m-read">Most Read</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#m-recent">Most Recent</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="m-read" class="container tab-pane active">
                        @php
                            $contents = App\Content::orderby('view', 'DESC')->limit(3)->get();
                        @endphp
                        @foreach ($contents as $content)
                        <div class="tn-news">
                            <div class="tn-img">
                                <img src="{{ url('images/'.$content->image) }}" height="115px" width="265px"/>
                            </div>
                            <div class="tn-title">
                                @if (app()->getLocale() == 'id')
                                    <a href="/id/berita/{{ $content->title }}">
                                        {{ $content->judul }}
                                    </a>
                                    @else
                                    <a href="/en/news/{{ $content->title_en }}">
                                        {{ $content->judul_en }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div id="m-recent" class="container tab-pane fade">
                        @php
                            $contents = App\Content::orderby('id', 'DESC')->limit(3)->get();
                        @endphp
                        @foreach ($contents as $content)
                        <div class="tn-news">
                            <div class="tn-img">
                                <img src="{{ url('images/'.$content->image) }}" height="115px" width="265px"/>
                            </div>
                            <div class="tn-title">
                                @if (app()->getLocale() == 'id')
                                    <a href="/id/berita/{{ $content->title }}">
                                        {{ $content->judul }}
                                    </a>
                                    @else
                                    <a href="/en/news/{{ $content->title_en }}">
                                        {{ $content->judul_en }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tab News Start-->

<!-- Main News Start-->
<div class="main-news">
    <div class="container">
        <div class="row">
            @php
                $contents = App\Content::orderby('id', 'DESC')->limit(6)->get();
            @endphp
            <div class="col-lg-9">
                <div class="row">
                    @foreach ($contents as $content)
                    <div class="col-md-4">
                        <div class="mn-img">
                            <img src="{{ url('images/'.$content->image) }}" height="225px" width="265px"/>
                            <div class="mn-title">
                                @if (app()->getLocale() == 'id')
                                    <a href="/id/berita/{{ $content->title }}" style="font-size: 14px;">
                                        {{ $content->judul }}
                                    </a>
                                    @else
                                    <a href="/en/news/{{ $content->title_en }}" style="font-size: 14px;">
                                        {{ $content->judul_en }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-3">
                @php
                    $contents = App\Content::orderby('id', 'DESC')->offset(6)->limit(6)->get();
                @endphp
                <div class="mn-list">
                    <h2>Read More</h2>
                    <ul>
                        @foreach ($contents as $content)
                        <li>@if (app()->getLocale() == 'id')
                            <a href="/id/berita/{{ $content->title }}">
                                {{ $content->judul }}
                            </a>
                            @else
                            <a href="/en/news/{{ $content->title_en }}">
                                {{ $content->judul_en }}
                            </a>
                            @endif</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
    });
</script>
@endsection
