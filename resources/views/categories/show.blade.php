@extends('layout')
@section('title')
show category
@endsection
@section('content')
    

<h3>Category : {{$theCategory->name}}</h3>

<h3>Books:</h3>

<ul>

    @foreach($theCategory->books as $book)
    <li>{{$book->title}}</li>
    @endforeach

</ul>
<a  href="{{route('categories.index')}}" class="btn btn-primary" type="button">back</a>


@endsection