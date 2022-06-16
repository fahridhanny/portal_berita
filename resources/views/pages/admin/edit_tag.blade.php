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
                <label for="exampleFormControlFile1">Name_Id</label>
                <input type="text" name="name_id" id="" placeholder="Name_Id" class="form-control @if($errors->has('name_id')) is-invalid @endif" value="{{ $tag->name_id }}">
                @if($errors->has('name_id'))
                    <p class="text-danger">{{ $errors->first('name_id') }}</p>
                @endif  
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Name_En</label>
                <input type="text" name="name_en" id="" placeholder="Name_En" class="form-control @if($errors->has('name_en')) is-invalid @endif" value="{{ $tag->name_en }}">
                @if($errors->has('name_en'))
                    <p class="text-danger">{{ $errors->first('name_en') }}</p>
                @endif  
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
@endsection