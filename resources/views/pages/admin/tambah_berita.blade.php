@extends('index_admin', ["heading" => "Berita"])

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
        Tambah Berita
    </div>
    <div class="card-body">
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
                        placeholder='Write your Tag Content'
                        class='flexdatalist form-control'
                        data-data='/admin/getTags'
                        data-search-in='name'
                        multiple='multiple'
                        data-min-length='1'
                        data-selection-required='true'
                        data-value-property='id'
                        data-min-length='1'
                        name='tag'>

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
                        </tbody>
                    </table>
                    @error('related')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
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

<!-- Modal Hapus -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Berita</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus Berita ini ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="" class="btn btn-danger">Hapus</a>
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
            minLength: 1,
            valueProperty: 'id',
            selectionRequired: true,
            searchIn: 'name',
            data: '/admin/getTags'
        });

        $('.flexdatalist2').flexdatalist({
            minLength: 0,
            valueProperty: 'id',
            selectionRequired: true,
            searchIn: 'judul',
            data: '/admin/getBerita'
        });
    </script>
    {{-- <script src="{{ asset('/vendor/laravel-filemanager/js/lfm.js') }}"></script> --}}
    {{-- <script type="text/javascript">
        var route_prefix = "/laravel-filemanager";
        $('#lfm').filemanager('image', {prefix: route_prefix});
    </script> --}}

    {{-- @foreach ($contents as $content)
    <script>
        $('#related-'+{{ $content->id }}).click(function(){
            $('#relatedValue').val('{{ $content->judul }}');
            $('#hapusRelated').show();
            $('#modalRelated').modal('hide');
            // $('ul').append("<li>"+content.judul+"<i class='fas fa-trash'></i></li>");
            // $('#modalRelated').modal('hide'); 
        });
    </script>
    @endforeach --}}

    <script>
    $(document).ready(function(){

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
                                                    "<button type='button' class='btn btn-danger'>"+
                                                    "<i class='fa-solid fa-trash-can'></i>"+
                                                    "</button>"+
                                                "</td>"+
                                            "</tr>");
            $('#modalRelated').modal('hide');
        });

        $('#selectRelated tbody').on('click','.fa-trash-can',function(){
            $(this).parents('tr').fadeOut(200);
        });

        // $('#hapusRelated').hide();

        // $('#tambahRelated').click(function(e){
            
        //     if($('#relatedValue').val() == ''){
        //        $('#messageRelated').text('Related tidak boleh kosong'); 
        //     }else{
        //         $('#formRelated').append("<div class='input-group mb-3'>"+
        //                     "<input type='text' class='form-control' name='related' placeholder='' aria-label='' aria-describedby='basic-addon2' id='relatedValue' readonly>"+
        //                     "<div class='input-group-append'>"+
        //                     "<button class='btn btn-outline-secondary' type='button' data-toggle='modal' data-target='#modalRelated'><i class='fa-solid fa-magnifying-glass'></i></button>"+
        //                     // "<button class='btn btn-danger' type='button' id='hapusRelated'><i class='fa-solid fa-trash-can'></i></button>"+
        //                     "</div>"+
        //             "</div>").children(":last");
        //         $('#messageRelated').text('');
        //     }
        // });

        // $.ajax({
        //     url: '/admin/getBerita',
        //     type: 'get',
        //     success: function(data){
        //         data.forEach(content => {
        //             $('#related-'+content.id).click(function(){
        //                 $('#relatedValue').val(content.judul);
        //                 $('#hapusRelated').show();
        //                 $('#modalRelated').modal('hide');
        //                 // $('ul').append("<li>"+content.judul+"<i class='fas fa-trash'></i></li>");
        //                 // $('#modalRelated').modal('hide'); 
        //             });    
        //         });
        //     },
        //     error: function(data){
        //         console.log(data);
        //     }
        // });

        // $('ul').on('click','.fa-trash',function(){
        //     $(this).parent('li').fadeOut(200);
        // });
        
        // $('#hapusRelated').click(function(){
        //     $('#relatedValue').val('');
        //     $(this).hide();
        // });    
    });
    </script>
@endsection