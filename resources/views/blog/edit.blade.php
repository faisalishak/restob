<!--@if (count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif-->

@extends('master')

@section('content')

<h2>Edit Article Post</h2>

<form class="" action="/blog/{{ $blog->id }}" method="post">
    <input type="text" name="title" value="{{ $blog->title }}" placeholder="this is title">   <br>
    {{ ($errors -> has('title')) ? $errors -> first('title') : '' }}<br>

    <textarea name="description" rows="8" cols="40" placeholder="this is description">{{ $blog->description }}</textarea><br>
    {{ ($errors -> has('description')) ? $errors -> first('description') : '' }}<br>

    <input type="hidden" name="_method" value="put">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" name="name" value="post"><br>
</form>

@stop