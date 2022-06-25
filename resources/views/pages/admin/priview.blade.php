@extends('index')

{{-- meta --}}
@if (app()->getLocale() == 'id')
    @section('meta_title', $content->meta ? $content->meta->meta_title : 'Default Title')
    @section('meta_keywords', $content->meta ? $content->meta->meta_title : 'Default Keywords')
    @section('meta_description', $content->meta ? $content->meta->meta_desc : 'Default Description')
@elseif (app()->getLocale() == 'en')
    @section('meta_title', $content->meta ? $content->meta->meta_title_en : 'Default Title')
    @section('meta_keywords', $content->meta ? $content->meta->meta_keywords_en : 'Default Keywords')
    @section('meta_description', $content->meta ? $content->meta->meta_desc_en : 'Default Description')
@endif
{{-- content --}}
@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">@if (app()->getLocale() == 'id')
                Berita
            @else
                News
            @endif</a></li>
            <li class="breadcrumb-item active">
                @if (app()->getLocale() == 'id')
                {{ $content->judul }}
                @else
                {{ $content->judul_en }}
                @endif
            </li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Single News Start-->
<div class="single-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="sn-container">
                    <div class="sn-img">
                        <img src="{{ url('images/'.$content->image) }}" height="385" width="456"/>
                    </div>
                    <div class="sn-content">
                        <h1 class="sn-title">@if (app()->getLocale() == 'id')
                            {{ $content->judul }}
                            @else
                            {{ $content->judul_en }}
                        @endif</h1>
                        <p>
                           @if (app()->getLocale() == 'id')
                               {!! $content->content !!}
                            @else
                                {!! $content->content_en !!}
                           @endif 
                        </p>
                    </div>
                </div>
                <div class="sn-container mb-3">
                    @if ($content->tag)
                        @php $list_tag = explode(',', $content->tag); @endphp
                        @foreach ($list_tag as $tag)
                            <a href="#" class="btn btn-outline-danger">{{ $tag }}</a>
                        @endforeach
                    @endif
                </div>
                <div class="sn-related">
                    @php
                        $releated = App\Content::where('id_category', $content->id_category)->orderby('id', 'DESC')->limit(3)->get();
                    @endphp
                    <h2>Related News</h2>
                    <div class="row sn-slider">
                        @foreach ($releated as $data)
                        <div class="col-md-4">
                            <div class="sn-img">
                                <img src="{{ url('images/'.$data->image) }}" height="165px" width="265px"/>
                                <div class="sn-title">
                                    @if (app()->getLocale() == 'id')
                                    <a href="" style="font-size: 14px;">{{ $data->judul }}</a>
                                    @else
                                    <a href="" style="font-size: 14px;">{{ $data->judul_en }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('layouts.rightbar')
        </div>
    </div>
</div>
<!-- Single News End-->
@endsection