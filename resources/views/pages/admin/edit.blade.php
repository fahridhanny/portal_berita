@extends('index_admin', ["heading" => "Edit Berita"])

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">
        Edit Berita
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="/admin/edit-berita/{{ $content->title }}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="title" value="{{ $content->title }}">
            <div class="form-group">
                <label for="exampleFormControlFile1">Category</label>
                <br>
                <select class="form-select" aria-label="Default select example" id="category" name="category">
                    @foreach ($category as $data)
                        <option @if($data->id == $content->id_category) selected @endif value="{{ $data->id }}">{{ $data->category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <p class="text-danger">{{ $errors->first('category') }}</p>
                @endif  
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Tag</label>
                <div class="row mb-3">
                    <div class="col-4">
                        <input type="text" name="tag" id="" placeholder="Tag" class="form-control  @if($errors->has('tag')) is-invalid @endif">
                    </div>
                    <div class="col-4">
                        <a href="javascript:void(0);" class="btn btn-white border border-dark" id="simpan_tag"><i class="fa-solid fa-plus"></i> Add Tag</a>
                    </div>
                </div>
                <div class="list_tag">
                    @php
                       $list_tag = explode(",", $content->tag); 
                    @endphp
                    @if ($content->tag)
                        @foreach ($list_tag as $tag)
                            <div class='row'>
                                <div class='col-3'>
                                    <div class='alert alert-secondary border border-dark alert-dismissible fade show' role='alert'>
                                        <input type='hidden' name='list_tag[]' value="{{ $tag }}">
                                        {{ $tag }}
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>  
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if($errors->has('list_tag'))
                    <p class="text-danger">{{ $errors->first('list_tag') }}</p>
                @endif 
                <p class="text-danger notif-salah"></p>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Judul</label>
                <input type="text" name="judul" id="" placeholder="Judul" class="form-control  @if($errors->has('judul')) is-invalid @endif" value="{{ $content->judul }}">
                @error('judul')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Judul_En</label>
                <input type="text" name="judul_en" id="" placeholder="Judul_En" class="form-control  @if($errors->has('judul_en')) is-invalid @endif" value="{{ $content->judul_en }}">
                @error('judul_en')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Content</label>
                <textarea id="summernote" name="content" placeholder="Content" class="form-control  @if($errors->has('content')) is-invalid @endif">
                    {{ $content->content }}
                </textarea>
                @error('content')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Content_En</label>
                <textarea id="summernote2" name="content_en" placeholder="Content_En" class="form-control  @if($errors->has('content_en')) is-invalid @endif">
                    {{ $content->content_en }}
                </textarea>
                @error('content_en')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Image</label>
                <br>
                <img src="{{ url('images/'.$content->image) }}" alt="{{ $content->title }}" width="200" height="157">
                <input type="hidden" name="imageValue" value="{{ $content->image }}"/>
                <br>
                <br>
                <input type="file" class="form-control-file @if($errors->has('image')) is-invalid @endif" id="img" name="image">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Meta_Title</label>
                <input type="text" name="meta_title" id="" placeholder="Meta_Title" class="form-control  @if($errors->has('meta_title')) is-invalid @endif" value="{{ $meta ? $meta->meta_title : ''}}">
                @error('meta_title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Meta_Desc</label>
                <input type="text" name="meta_desc" id="" placeholder="Meta_Desc" class="form-control  @if($errors->has('meta_desc')) is-invalid @endif" value="{{ $meta ? $meta->meta_desc : '' }}">
                @error('meta_desc')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Meta_Keywords</label>
                <input type="text" name="meta_keywords" id="" placeholder="Meta_Keywords" class="form-control  @if($errors->has('meta_keywords')) is-invalid @endif" value="{{ $meta ? $meta->meta_keywords : '' }}">
                @error('meta_keywords')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Meta_Title_En</label>
                <input type="text" name="meta_title_en" id="" placeholder="Meta_Title_En" class="form-control  @if($errors->has('meta_title_en')) is-invalid @endif" value="{{ $meta ? $meta->meta_title_en : '' }}">
                @error('meta_title_en')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Meta_Desc_En</label>
                <input type="text" name="meta_desc_en" id="" placeholder="Meta_Desc_En" class="form-control  @if($errors->has('meta_desc_en')) is-invalid @endif" value="{{ $meta ? $meta->meta_desc_en : '' }}">
                @error('meta_desc_en')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Meta_Keywords_En</label>
                <input type="text" name="meta_keywords_en" id="" placeholder="Meta_Keywords_En" class="form-control  @if($errors->has('meta_keywords_en')) is-invalid @endif" value="{{ $meta ? $meta->meta_keywords_en : '' }}">
                @error('meta_keywords_en')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            {{-- <div class="form-group">
                <div class="input-group">
                    <span class="input-group-btn">
                      <a id="imageLFM" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa-solid fa-image"></i> Choose
                      </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="filepath">
                </div>
                <img id="holder" style="margin-top:15px;max-height:100px;">
            </div> --}}
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
    
    {{-- <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>

    <script type="text/javascript">
        var route_prefix = "/laravel-filemanager";
        $('#imageLFM').filemanager('image', {prefix: route_prefix});
    </script> --}}

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            height: '800px'
        };
        var options2 = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            height: '800px'
        };
    </script>
    <script>
        CKEDITOR.replace('summernote', options);
        CKEDITOR.replace('summernote2', options2);
    </script>
    <script type="text/javascript">
        $("#simpan_tag").click(function( event ) {
            event.preventDefault();
            var tag = $("input[name=tag]").val();
            if (tag) {
                $(".notif-salah").text("");
                $(".list_tag").append("<div class='row'>"+
                    "<div class='col-3'>"+
                        "<div class='alert alert-secondary border border-dark alert-dismissible fade show' role='alert'>"+
                            "<input type='hidden' name='list_tag[]' value="+tag+">"+
                            tag+
                            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
                              "<span aria-hidden='true'>&times;</span>"+
                            "</button>"+
                        "</div>"+  
                    "</div>"+
                "</div>").children(":last");
            
                $("input[name=tag]").val("");
            }else{
                $(".notif-salah").text("masukkan tag!");
            }
        });
    </script>
@endsection