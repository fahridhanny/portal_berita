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
                    {{-- <td><a href="/admin/hapus-contact/{{ $data->id }}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td> --}}
                    <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-{{ $data->id }}"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

<!-- Modal Hapus -->
@foreach ($contact as $data)
<div class="modal fade" id="exampleModal-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Contact</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus Contact ini ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="/admin/hapus-contact/{{ $data->id }}" class="btn btn-danger">Hapus</a>
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
