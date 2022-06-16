<div class="col-lg-4">
    <div class="sidebar">
        <div class="sidebar-widget">
            <h2 class="sw-title">In This Category</h2>
            <div class="news-list">
                @php
                    $detail = App\Content::where('id_category', $content->id_category)->orderby('id', 'DESC')->limit(3)->get();
                @endphp
                @foreach ($detail as $data)
                <div class="nl-item">
                    <div class="nl-img">
                        <img src="{{ url('images/'.$data->image) }}" />
                    </div>
                    <div class="nl-title">
                        @if (app()->getLocale() == 'id')
                        <a href="/id/berita/{{ $data->title }}">{{ $data->judul }}</a>
                        @else
                        <a href="/en/news/{{ $data->title_en }}">{{ $data->judul_en }}</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="sidebar-widget">
            <div class="image">
                <a href="https://htmlcodex.com"><img src="{{ url('img/ads-2.jpg') }}" alt="Image"></a>
            </div>
        </div>

        <div class="sidebar-widget">
            <h2 class="sw-title">News Category</h2>
            <div class="category">
                @php
                    $kategories = App\Category::all();
                @endphp
                <ul>
                    @foreach ($kategories as $data)
                    <li>
                        @if (app()->getLocale() == 'id')
                        <a href="">{{ $data->category }}</a><span>(98)</span>
                        @else
                        <a href="">{{ $data->category_en }}</a><span>(98)</span>    
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- <div class="sidebar-widget">
            <div class="image">
                <a href="https://htmlcodex.com"><img src="{{ url('img/ads-2.jpg') }}" alt="Image"></a>
            </div>
        </div> --}}
        
        {{-- <div class="sidebar-widget">
            <h2 class="sw-title">Tags Cloud</h2>
            <div class="tags">
                <a href="">National</a>
                <a href="">International</a>
                <a href="">Economics</a>
                <a href="">Politics</a>
                <a href="">Lifestyle</a>
                <a href="">Technology</a>
                <a href="">Trades</a>
            </div>
        </div> --}}
    </div>
</div>