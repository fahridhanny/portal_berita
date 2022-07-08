@extends('index_admin', ["heading" => "Data Tag"])

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Tag</h3>
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
                <th>Name</th>
                <th>Description</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($tag as $data)
                <tr>
                    <th>{{ $no++ }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->description }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a href="/admin/edit-tag/{{ $data->id }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                            {{-- <a href="/admin/hapus-tag/{{ $data->id }}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a> --}}
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-{{ $data->id }}"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/admin/tambah-tag" class="btn btn-success">Tambah Tag</a>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

<!-- Modal Hapus -->
@foreach ($tag as $data)
<div class="modal fade" id="exampleModal-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Tag</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus Tag ini ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="/admin/hapus-tag/{{ $data->id }}" class="btn btn-danger">Hapus</a>
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
