@extends('index_admin', ["heading" => "Data Banner"])

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Banner</h3>
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
                <th>Image</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($banner as $data)
                <tr>
                    <th>{{ $no++ }}</th>
                    <td>{{ $data->title }}</td>
                    <td><img src="{{ url('images/banner/'.$data->image) }}" alt="{{ $data->title }}" height="154" width="154"></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="/admin/edit-banner/{{ $data->title }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                            {{-- <a href="/admin/hapus-banner/{{ $data->title }}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a> --}}
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-{{ $data->id }}"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/admin/tambah-banner" class="btn btn-success">Tambah Banner</a>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

<!-- Modal Hapus -->
@foreach ($banner as $data)
<div class="modal fade" id="exampleModal-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Banner</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus Banner ini ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="/admin/hapus-banner/{{ $data->title }}" class="btn btn-danger">Hapus</a>
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
@endsection
