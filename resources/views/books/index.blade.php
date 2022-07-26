@extends('layout')
@section('title')
All books
@endsection
@section('content')
<h1>hello from books</h1>
<a href="{{route('books.create')}}" class="btn btn-primary" type="button" >Create
</a>

<br>
@foreach ($books as $book)
<hr>
the title is :{{$book->title}}
<br>
the description is :{{$book->desc}}
<a href="{{route('books.show',$book->id)}}" class="btn btn-primary" type="button" >show
</a>

<a href="{{route('books.edit',$book->id)}}" class="btn btn-success" type="button" >edit
</a>

<a href="{{route('books.delete',$book->id)}}" class="btn btn-danger" type="button" >Delete
</a>



@endforeach


@endsection