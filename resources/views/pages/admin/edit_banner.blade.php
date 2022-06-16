@extends('index_admin', ["heading" => "Edit Banner"])

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">
        Edit Banner
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="/admin/edit-banner/{{ $banner->title }}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlFile1">Title</label>
                <input type="text" name="title" id="" placeholder="Title" class="form-control  @if($errors->has('title')) is-invalid @endif" value="{{ $banner->title }}">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Image</label>
                <br>
                <img src="{{ url('images/banner/'.$banner->image) }}" alt="{{ $banner->title }}" width="200" height="157">
                <input type="hidden" name="imageValue" value="{{ $banner->image }}"/>
                <br>
                <br>
                <input type="file" class="form-control-file @if($errors->has('image')) is-invalid @endif" id="img" name="image">
                @error('image')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
@endsection