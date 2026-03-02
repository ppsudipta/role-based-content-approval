@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    {{-- ✅ Only Author can create --}}
    @if(auth()->user()->isAuthor())
        <a href="/posts/create" class="btn btn-primary">Create Post</a>
    @endif

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>
</div>



<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>
        <th>Status</th>
        <th>Author</th>
        <th>Actions</th>
    </tr>

    @foreach($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ Str::limit($post->body, 50) }}</td>
        <td>
            {{-- 🔥 Nice UI for status --}}
            @if($post->status == 'pending')
                <span class="badge bg-warning text-dark">Pending</span>
            @elseif($post->status == 'approved')
                <span class="badge bg-success">Approved</span>
            @else
                <span class="badge bg-danger">Rejected</span>
                <small class="text-muted">{{ $post->rejected_reason }}</small>
            @endif
        </td>
        <td>{{ $post->author->name }}</td>

        <td>

            {{-- ✅ EDIT (only author + pending) --}}
            @can('update', $post)
                @if($post->status == 'pending')
                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                @endif
            @endcan

            <a href="{{ route('posts.logs', $post->id) }}" class="btn btn-info btn-sm">Logs</a>

            {{-- ✅ APPROVE / REJECT only if pending --}}
            @can('approve', $post)
                @if($post->status == 'pending')

                    {{-- Approve --}}
                    <form action="/posts/{{ $post->id }}/approve" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>



                    {{-- Reject --}}
                    <form action="/posts/{{ $post->id }}/reject" method="POST" style="display:inline;">
                        @csrf
                        <input type="text" name="reason" placeholder="Reason" required class="form-control d-inline" style="width:120px;">
                        <button class="btn btn-danger btn-sm">Reject</button>
                    </form>

                @endif
            @endcan

            {{-- ✅ DELETE only admin --}}
            @can('delete', $post)
                <form action="/posts/{{ $post->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endcan

        </td>
    </tr>
    @endforeach

</table>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}

    </div>

@endsection