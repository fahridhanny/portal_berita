@extends('index_admin', ["heading" => "Data Category"])

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Category</h3>
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
                <th>Category</th>
                <th>Category_En</th>
                <th>Edit</th>
                <th>Hapus</th>
            </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($category as $data)
                <tr>
                    <th>{{ $no++ }}</th>
                    <td>{{ $data->category }}</td>
                    <td>{{ $data->category_en }}</td>
                    <td><a href="/admin/edit-kategori/{{ $data->category }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a href="/admin/hapus-kategori/{{ $data->id }}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/admin/tambah-kategori" class="btn btn-success">Tambah Category</a>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
<script type="text/javascript">
$(document).ready( function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
@endsection
