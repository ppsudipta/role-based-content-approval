@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">Create Post</h3>

    {{-- 🔥 GLOBAL ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Something went wrong!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        {{-- TITLE --}}
        <div class="mb-3">
            <label class="form-label">Title</label>

            <input 
                type="text" 
                name="title" 
                value="{{ old('title') }}" 
                class="form-control @error('title') is-invalid @enderror"
                placeholder="Enter post title"
            >

            {{-- FIELD ERROR --}}
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- BODY --}}
        <div class="mb-3">
            <label class="form-label">Content</label>

            <textarea 
                name="body" 
                rows="5"
                class="form-control @error('body') is-invalid @enderror"
                placeholder="Write your content..."
            >{{ old('body') }}</textarea>

            {{-- FIELD ERROR --}}
            @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- BUTTONS --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                Back
            </a>

            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>

    </form>

</div>

@endsection