@extends('layouts.main')

@section('title', 'Notifikasi')

@section('content')
    <h1>Notifikasi</h1>

    @if($notifications->isEmpty())
        <p>Belum ada notifikasi.</p>
    @else
        <ul>
            @foreach($notifications as $note)
                <li>
                    {{ $note->data['message'] ?? '–' }}
                    <small>({{ $note->created_at->diffForHumans() }})</small>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
