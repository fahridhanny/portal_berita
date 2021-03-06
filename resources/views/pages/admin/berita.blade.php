@extends('index_admin', ["heading" => "Data Berita"])

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Berita</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table id="example1" class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>No. </th>
                <th>Title</th>
                <th>Judul</th>
                <th>Image</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($contents as $content)
                <tr>
                    <th>{{ $no++ }}</th>
                    <td>{{ $content->title }}</td>
                    <td>{{ $content->judul }}</td>
                    <td><img src="{{ url('images/'.$content->image) }}" alt="{{ $content->title }}" height="154" width="154"></td>
                    <td>
                        <select class="form-control" aria-label="Default select example" id="status-{{ $content->id }}" name="status" data="{{ $content->id }}">
                            <option value="1" @if ($content->status == 1) selected @endif>Draft</option>
                            <option value="2" @if ($content->status == 2) selected @endif>Submited</option>
                        </select>
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="/admin/priview/berita/{{ $content->title }}" class="btn btn-warning" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            <a href="/admin/edit-berita/{{ $content->title }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                            {{-- <a href="/admin/hapus-berita/{{ $content->title }}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a> --}}
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-{{ $content->id }}"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/admin/tambah-berita" class="btn btn-success">Tambah Berita</a>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

<!-- Modal Hapus -->
@foreach ($contents as $content)
<div class="modal fade" id="exampleModal-{{ $content->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a href="/admin/hapus-berita/{{ $content->title }}" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
</div>
@endforeach

<script type="text/javascript">
    $(document).ready( function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@foreach ($contents as $content)
    <script type="text/javascript">
        var id = "<?php echo $content->id ?>";
        $("#status-"+id).on("change", function(e){
            e.preventDefault();
            var status = $(this).val();
            var idBerita = $(this).attr("data");
            $.ajax({
                url: '/admin/publish-berita',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status,
                    id: idBerita
                },
                dataType: "json",
                success:function(data){
                    alert(data.message);
                },
                error:function(data){
                    alert(data.message);
                }
            });
        });
    </script>    
@endforeach

@endsection
