@extends('master')

{{ Session::get('message') }}

@section('content')

<h1>My first blog</h1>


@foreach ($blogs as $blog) 
    <a href="/blog/{{ $blog->id }}"><h2>{{ $blog -> title }}</h2></a>
    <p>{{ $blog -> description }}</p>
    <p>{{ date('F d, Y', strtotime($blog -> created_at)) }}</p>
    <a href="/blog/{{ $blog->id }}/edit">Edit</a><br>
    <form class="" action="/blog/{{ $blog->id }}" method="post">
        <input type="hidden" name="_method" value="delete">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" name="name" value="delete">
    </form>
    <hr>
@endforeach

{!! $blogs->links() !!}

@stop

@section('sidebar2')

    <h4>Archives</h4>
    <ol class="list-unstyled">
        @foreach ($blogs as $blog) 
        <li><a href="/blog/{{ $blog->id }}">{{ $blog -> description }}</a></li>
        @endforeach
    </ol>
@stop

