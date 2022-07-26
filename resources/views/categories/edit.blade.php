@extends('layout')
@section('title')
edit category {{$editCategory->name}}
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-danger">
  @foreach($errors->all() as $error)
  <p>{{$error}}</p>
@endforeach
</div>
@endif

<form method="POST" action="{{route('categories.update',$editCategory->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{old('name') ?? $editCategory->title}}">
    
    
    <button type="submit" class="btn btn-success">Update</button>
    
  </form>
@endsection