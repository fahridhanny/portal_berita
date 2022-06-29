@extends('index_admin', ["heading" => "Berita"])

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="#add" role="tab" aria-controls="add" aria-selected="true">Add</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#related" role="tab" aria-controls="related" aria-selected="false">Related</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
       <div class="tab-content mt-3">
        <div class="tab-pane active" id="add" role="tabpanel">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="/admin/tambah-berita" method="post" class="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group" style="margin-right: 70%">
                    <label for="exampleFormControlFile1">Category</label>
                    <br>
                    <select class="form-control @if($errors->has('category')) is-invalid @endif" aria-label="Default select example" id="category" name="category">
                        <option value="">-- Pilih Category --</option>
                        @foreach ($category as $data)
                            <option value="{{ $data->id }}">{{ $data->category }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category'))
                        <p class="text-danger">{{ $errors->first('category') }}</p>
                    @endif  
                </div>
                <div class="form-group" style="margin-right: 50%">
                    <label for="browser" class="form-label">Tag</label>
                    <input type='text'
                        placeholder='Pilih Tag'
                        class='flexdatalist form-control'
                        data-min-length='1'
                        multiple=''
                        data-selection-required='1'
                        list='tags'
                        name='tag'>

                    <datalist id="tags">
                        @if ($tag)
                            @foreach ($tag as $data)
                                <option value="{{ $data->name }}">{{ $data->name }}</option>  
                            @endforeach
                        @endif
                    </datalist>
                    @if($errors->has('tag'))
                        <p class="text-danger">{{ $errors->first('tag') }}</p>
                    @endif  
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Judul</label>
                    <input type="text" name="judul" id="" placeholder="Judul" class="form-control  @if($errors->has('judul')) is-invalid @endif">
                    @error('judul')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Judul_En</label>
                    <input type="text" name="judul_en" id="" placeholder="Judul_En" class="form-control  @if($errors->has('judul_en')) is-invalid @endif">
                    @error('judul_en')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Content</label>
                    <textarea id="summernote" name="content" class="form-control @if($errors->has('content')) is-invalid @endif">
                    
                    </textarea>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Content_En</label>
                    <textarea id="summernote2" name="content_en" class="form-control @if($errors->has('content_en')) is-invalid @endif">
                        
                    </textarea>
                    @error('content_en')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" class="form-control-file @if($errors->has('image')) is-invalid @endif" id="img" name="image">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Meta_Title</label>
                    <input type="text" name="meta_title" id="" placeholder="Meta_Title" class="form-control  @if($errors->has('meta_title')) is-invalid @endif">
                    @error('meta_title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Meta_Desc</label>
                    <input type="text" name="meta_desc" id="" placeholder="Meta_Desc" class="form-control  @if($errors->has('meta_desc')) is-invalid @endif">
                    @error('meta_desc')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Meta_Keywords</label>
                    <input type="text" name="meta_keywords" id="" placeholder="Meta_Keywords" class="form-control  @if($errors->has('meta_keywords')) is-invalid @endif">
                    @error('meta_keywords')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Meta_Title_En</label>
                    <input type="text" name="meta_title_en" id="" placeholder="Meta_Title_En" class="form-control  @if($errors->has('meta_title_en')) is-invalid @endif">
                    @error('meta_title_en')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Meta_Desc_En</label>
                    <input type="text" name="meta_desc_en" id="" placeholder="Meta_Desc_En" class="form-control  @if($errors->has('meta_desc_en')) is-invalid @endif">
                    @error('meta_desc_en')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Meta_Keywords_En</label>
                    <input type="text" name="meta_keywords_en" id="" placeholder="Meta_Keywords_En" class="form-control  @if($errors->has('meta_keywords_en')) is-invalid @endif">
                    @error('meta_keywords_en')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
         
        <div class="tab-pane" id="related" role="tabpanel" aria-labelledby="history-tab">  
            <form action="/admin/tambah-berita" method="post" class="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlFile1">Related</label>
                    <input type="text" name="meta_keywords_en" id="" placeholder="Related" class="form-control  @if($errors->has('meta_keywords_en')) is-invalid @endif">
                    @error('meta_keywords_en')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Add Related</button>
            </form>
        </div>
      </div>
    </div>
</div>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    var options2 = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
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
    <script>
        $('.flexdatalist').flexdatalist({
            selectionRequired: 1,
            minLength: 1
        });
    </script>
    <script>
        $('#bologna-list a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endsection