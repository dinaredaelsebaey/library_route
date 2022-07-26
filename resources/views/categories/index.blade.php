@extends('layout')
@section('title')
All categories
@endsection
@section('content')
<h1>hello from categories</h1>
<a href="{{route('categories.create')}}" class="btn btn-primary" type="button" >Create
</a>

<br>
@foreach ($categories as $category)
<hr>
the name is :{{$category->name}}
<br>
<a href="{{route('categories.show',$category->id)}}" class="btn btn-primary" type="button" >show
</a>

<a href="{{route('categories.edit',$category->id)}}" class="btn btn-success" type="button" >edit
</a>

<a href="{{route('categories.delete',$category->id)}}" class="btn btn-danger" type="button" >Delete
</a>


@endforeach

{{-- {{$categories->render()}} --}}
@endsection