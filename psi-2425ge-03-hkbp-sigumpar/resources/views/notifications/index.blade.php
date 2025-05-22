@extends('layouts.main')

@section('title', 'Notifikasi')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-center text-primary">Notifikasi</h1>

        @if($notifications->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                Belum ada notifikasi.
            </div>
        @else
            <div class="row">
                @foreach($notifications as $note)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card notification-card shadow-lg border-light rounded-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-bell me-3 text-warning notification-icon"></i>
                                    <span class="fw-bold text-dark notification-message">{{ $note->data['message'] ?? '–' }}</span>
                                </div>
                                <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
                            </div>

                            <div class="card-footer text-end">
                                <button class="btn btn-sm btn-outline-primary notification-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Tindak lanjuti">Tindak Lanjut</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        /* General Card Styles */
        .notification-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .notification-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Icon Styling */
        .notification-icon {
            font-size: 24px;
        }

        /* Notification Message Styling */
        .notification-message {
            font-size: 16px;
        }

        /* Button Styling */
        .notification-btn {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .notification-btn:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Tooltip initialization
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
@endpush
