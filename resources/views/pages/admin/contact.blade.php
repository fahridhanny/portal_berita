@extends('index_admin', ["heading" => "Data Contact"])

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Contact</h3>
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
                <th>Nama</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Hapus</th>
            </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($contact as $data)
                <tr>
                    <th>{{ $no++ }}</th>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->subject }}</td>
                    <td>{!! strip_tags($data->message) !!}</td>
                    <td><a href="/admin/hapus-contact/{{ $data->id }}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
