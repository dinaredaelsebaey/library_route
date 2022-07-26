@extends('layout')
@section('title')
register
@endsection

@section('content')
@if($errors->any())
<div class="alert alert-danger">
  @foreach($errors->all() as $error)
  <p>{{$error}}</p>
@endforeach
</div>
@endif

<form  method="POST" action="{{route('auth.handleRegister')}}">
  @csrf
    <div class="mb-3">
        <label  class="form-label">Name</label>
        <input type="text" name="name" class="form-control"  value="{{old('name')}}">
    </div>
    
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email"  name="email" class="form-control" id="exampleInputEmail1"  value="{{old('email')}}">

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" >
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  @endsection