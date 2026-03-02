@extends('layouts.app')

@section('content')

<h3>Activity Logs for: {{ $post->title }}</h3>

<a href="{{ route('posts.index') }}" class="btn btn-secondary mb-3">Back</a>

<table class="table table-bordered">
    <tr>
        <th>Action</th>
        <th>Performed By</th>
        <th>Details</th>
        <th>Date</th>
    </tr>

    @forelse($logs as $log)
    <tr>
        <td>
            @if($log->action == 'created')
                <span class="badge bg-primary">Created</span>
            @elseif($log->action == 'approved')
                <span class="badge bg-success">Approved</span>
            @elseif($log->action == 'rejected')
                <span class="badge bg-danger">Rejected</span>
            @elseif($log->action == 'deleted')
                <span class="badge bg-dark">Deleted</span>
            @else
                <span class="badge bg-secondary">{{ $log->action }}</span>
            @endif
        </td>

        <td>{{ $log->user->name ?? 'N/A' }}</td>

        <td>
            {{-- Show reason if exists --}}
            @if(isset($log->meta['reason']))
                <strong>Reason:</strong> {{ $log->meta['reason'] }}
            @else
                -
            @endif
        </td>

        <td>{{ $log->created_at->format('d M Y H:i') }}</td>
    </tr>
    @empty
        <tr>
            <td colspan="4">No logs found</td>
        </tr>
    @endforelse
</table>

@endsection