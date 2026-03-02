@extends('layouts.app')

@section('content')

<form method="POST" action="/posts/{{ $post->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $post->title }}" class="form-control mb-2">

    <textarea name="body" class="form-control mb-2">{{ $post->body }}</textarea>

    <button class="btn btn-primary">Update</button>

</form>

@endsection