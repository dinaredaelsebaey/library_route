@extends('layout')
@section('title')
create books
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-danger">
  @foreach($errors->all() as $error)
  <p>{{$error}}</p>
@endforeach
</div>

@endif

<form method="POST" action="{{route('books.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" id="exampleInputEmail1" value="{{old('title')}}">
      
    <div class="mb-3">
      <label  class="form-label">Description</label>
      <textarea name="desc" class="form-control" id="exampleInputPassword1">{{old('desc')}}</textarea>
    </div>

    <div class="mb-3">
      <label  class="form-label">Image</label>
      <input type="file" name="img" class="form-control" id="exampleInputEmail1" value="">
    </div>
    
    <button type="submit" class="btn btn-primary">Store</button>
  </form>
@endsection