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
            <div class="form-group" style="margin-right: 70%">
                <label for="exampleFormControlFile1">Category</label>
                <br>
                <select class="form-control" aria-label="Default select example" id="category" name="category">
                    @foreach ($category as $data)
                        <option @if($data->id == $content->id_category) selected @endif value="{{ $data->id }}">{{ $data->category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <p class="text-danger">{{ $errors->first('category') }}</p>
                @endif  
            </div>
            <div class="form-group" style="margin-right: 50%">
                @php
                    $tagNew = array();
                    foreach ($content_tag as $key => $value) {
                        array_push($tagNew, $value->name);
                    }
                    $tags = implode(',',$tagNew);
                @endphp
                <label for="browser" class="form-label">Tag</label>
                <input type='text'
                        value='{{ $tags }}'
                        placeholder='Write your country name'
                        class='flexdatalist form-control'
                        data-data='/admin/getTags'
                        data-search-in='name'
                        data-visible-properties='["name"]'
                        data-selection-required='true'
                        data-value-property='name'
                        data-text-property='{name}'
                        data-min-length='1'
                        multiple='multiple'
                        name='tag'>

                @if($errors->has('tag'))
                    <p class="text-danger">{{ $errors->first('tag') }}</p>
                @endif  
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
            <div class="form-group" style="margin-right: 50%" id="formRelated">
                <label for="exampleFormControlFile1">Related</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2" id="relatedValue" readonly>
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#modalRelated"><i class="fa-solid fa-magnifying-glass"></i></button>
                      {{-- <button class='btn btn-danger' type='button' id='hapusRelated'><i class='fa-solid fa-trash-can'></i></button> --}}
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin-right: 30%;">
                <table class="table table-striped" id="selectRelated">
                    <thead>
                      <tr>
                        <th scope="col">Judul</th>
                        <th scope="col">Hapus</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($content_related as $data)
                        <tr>
                            <input type='hidden' value="{{ $data->id }}" name='related[]'>
                            <td>{{ $data->judul }}</td>
                            <td>
                                <button type='button' class='btn btn-danger' id="hapusRelated-{{ $data->id }}">
                                <i class='fa-solid fa-trash-can'></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>

  <!-- Modal Related -->
<div class="modal fade" id="modalRelated" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Related</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table id="tableRelated" class="table table-striped table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>No. </th>
                    <th>Judul</th>
                    <th>Pilih</th>
                </tr>
                </thead>
                {{-- <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($contents as $content)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $content->judul }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" id="related-{{ $content->id }}"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody> --}}
            </table>
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
    {{-- <script type="text/javascript">
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
    </script> --}}
    <script>
        $('.flexdatalist').flexdatalist({
            selectionRequired: true,
            minLength: 1,
            textProperty: '{name}',
            valueProperty: 'name',
            selectionRequired: true,
            visibleProperties: ["name"],
            searchIn: 'name',
            data: '/admin/getTags'
        });
    </script>
    <script>
        $('.flexdatalist2').flexdatalist({
            minLength: 0,
            valueProperty: 'judul',
            selectionRequired: true,
            searchIn: 'judul',
            data: '/admin/getBerita'
        });
    </script>
    <script>
    $(document).ready(function(){
        var id = {{ $content->id }};
        
        var table = $("#tableRelated").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            ajax: {
                url: '/admin/getBeritaAll',
                dataSrc: 'data'
            },
            columns: [
                {data: 'judul_en'},
                {data: 'judul'},
                {data: null, 
                 render: function(data, type, row){
                    return "<button type='button'"+ 
                    "class='btn btn-primary' id='related'>"+
                    "<i class='fa-solid fa-magnifying-glass'>"+
                    "</i></button>"}
                }
            ],
            order: [
                [2, 'desc'],
            ]
        });

        table.on('order.dt search.dt', function () {
            let i = 1;
    
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
        
        $('#tableRelated tbody').on('click', 'button', function () {
            var data = table.row($(this).parents('tr')).data();

            $('#relatedValue').val(data["judul"]);
            $('#selectRelated tbody').append("<tr>"+
                                                "<td><input type='hidden' value='"+data["id"]+"' name='related[]'>"+data["judul"]+"</td>"+
                                                "<td>"+
                                                    "<button type='button' class='btn btn-danger' id='hapusRelated-"+data["id"]+"'>"+
                                                    "<i class='fa-solid fa-trash-can'></i>"+
                                                    "</button>"+
                                                "</td>"+
                                            "</tr>");
            $('#modalRelated').modal('hide');
        });


        $.ajax({
            url: '/admin/related/'+id ,
            type: 'get',
            success: function(data){
                data.forEach(value => {
                    $('#hapusRelated-'+value.id_related).on('click', function(){
                        $(this).parents('tr').fadeOut(200);

                        $.ajax({
                            url: '/admin/hapus-related/'+id+'/'+value.id_related ,
                            type: 'get'
                        });
                    });
                });
            },
            error: function(data){
                console.log(data);
            }
        });

        $('#selectRelated tbody').on('click','.fa-trash-can',function(){
            $(this).parents('tr').fadeOut(200);
        });
    });
    </script>
@endsection