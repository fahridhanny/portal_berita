@extends('index_admin', ["heading" => "Edit User"])

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">
        Edit User
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="/admin/edit-user/{{ $user->id }}" method="post" class="form">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlFile1">Nama</label>
                <input type="text" name="nama" id="" placeholder="Nama" class="form-control @if($errors->has('nama')) is-invalid @endif" value="{{ $user->name }}">
                @if($errors->has('nama'))
                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                @endif  
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Email</label>
                <input type="email" name="email" id="" placeholder="Email" class="form-control @if($errors->has('email')) is-invalid @endif" value="{{ $user->email }}">
                @if($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif  
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
@endsection