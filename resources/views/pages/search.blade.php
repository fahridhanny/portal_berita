@extends('index')

{{-- meta --}}
{{-- @if (app()->getLocale() == 'id')
    @section('meta_title', $content->meta ? $content->meta->meta_title : 'Default Title')
    @section('meta_keywords', $content->meta ? $content->meta->meta_title : 'Default Keywords')
    @section('meta_description', $content->meta ? $content->meta->meta_desc : 'Default Description')
@elseif (app()->getLocale() == 'en')
    @section('meta_title', $content->meta ? $content->meta->meta_title_en : 'Default Title')
    @section('meta_keywords', $content->meta ? $content->meta->meta_keywords_en : 'Default Keywords')
    @section('meta_description', $content->meta ? $content->meta->meta_desc_en : 'Default Description')
@endif --}}
{{-- content --}}
@section('content')
<style>
  #judul:hover{
    color:blue;
  }
</style>
<!-- Single News Start-->
<div class="single-news">
    <div class="container">
      @foreach ($contents as $content)
        <div class="row mt-4">
            <div class="card mb-3" style="max-width: 540px; border: none;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{ url('images/'.$content->image) }}" class="img-fluid rounded-start" alt="{{ $content->title }}">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      @if (app()->getLocale() == 'id')
                      <a href="/id/berita/{{ $content->title }}">
                        <h5 class="card-title" id="judul">
                          {{ $content->judul }}
                        </h5>
                      </a>
                      @else
                      <a href="/en/news/{{ $content->title_en }}">
                        <h5 class="card-title" id="judul">
                          {{ $content->judul_en }}
                        </h5>
                      </a>
                      @endif
                      <p class="card-text"><small class="text-muted">{{ $content->updated_at->diffForHumans() }}</small></p>
                      <p class="card-text" style="font-size:15px;">
                      @if (app()->getLocale() == 'id')
                      {!! str_limit(strip_tags($content->content), 50) !!}  
                      @else
                      {!! str_limit(strip_tags($content->content_en), 50) !!}
                      @endif
                      </p>
                    </div>
                  </div>
                </div>
            </div>
            {{-- @include('layouts.rightbar') --}}
        </div>
      @endforeach
    </div>
</div>
@endsection