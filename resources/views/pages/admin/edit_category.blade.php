@extends('index_admin', ["heading" => "Edit Category"])

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title">
        Edit Category
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="/admin/edit-kategori/{{ $category->category }}" method="post" class="form">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlFile1">Category</label>
                <input type="text" name="category" id="" placeholder="Category" class="form-control @if($errors->has('category')) is-invalid @endif" value="{{ $category->category }}">
                @if($errors->has('category'))
                    <p class="text-danger">{{ $errors->first('category') }}</p>
                @endif  
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Category_En</label>
                <input type="text" name="category_en" id="" placeholder="Category_En" class="form-control @if($errors->has('category_en')) is-invalid @endif" value="{{ $category->category_en }}">
                @if($errors->has('category_en'))
                    <p class="text-danger">{{ $errors->first('category_en') }}</p>
                @endif  
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
  </div>
@endsection