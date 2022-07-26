@extends('layout')
@section('title')
show book
@endsection
@section('content')
    

<h3>Book : {{$theBook->title}}</h3>
<br>
<h3>Categories :</h3>

<ul>

    @foreach($theBook->categories as $category)
    <li>{{$category->name}}</li>
    @endforeach

</ul>

<a  href="{{route('books.index')}}" class="btn btn-primary" type="button">back</a>


@endsection