@extends('index_admin', ["heading" => "Edit Tag"])

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">
        Edit Tag
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="/admin/edit-tag/{{ $tag->id }}" method="post" class="form">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlFile1">Name</label>
                <input type="text" name="name" id="" placeholder="Name" class="form-control @if($errors->has('name')) is-invalid @endif" value="{{ $tag->name }}">
                @if($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif  
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Description</label>
                <input type="text" name="description" id="" placeholder="Description" class="form-control @if($errors->has('description')) is-invalid @endif" value="{{ $tag->description }}">
                @if($errors->has('description'))
                    <p class="text-danger">{{ $errors->first('description') }}</p>
                @endif  
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
@endsection