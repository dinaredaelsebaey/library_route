@extends('layout')
@section('title')
create categories
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-danger">
  @foreach($errors->all() as $error)
  <p>{{$error}}</p>
@endforeach
</div>

@endif

<form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{old('name')}}">
      
    
    <button type="submit" class="btn btn-primary">Store</button>
  </form>
@endsection