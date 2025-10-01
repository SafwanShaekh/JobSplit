@extends('admin.layouts.app')

@section('content')

{{-- Naye design ke liye custom CSS (bilkul wesi hi hai) --}}
<style>
    /* === THEME VARIABLES (from your layout) === */
    :root {
        /* Light Theme */
        --light-bg: #f4f7fe;
        --light-card-bg: #ffffff;
        --light-text: #2c3e50;
        --light-text-secondary: #7f8c8d;
        --light-border-color: #e0e6ed;

        /* Dark Theme */
        --dark-bg: #161928;
        --dark-card-bg: #20243c;
        --dark-text: #ffffff;
        --dark-text-secondary: #a0aec0;
        --dark-border-color: #2f3349;
        
        /* Accent Colors */
        --gradient-pink: linear-gradient(90deg, #b13ff7, #ff00c3);
        --accent-blue: #5469D4;
    }

    /* === Dynamic Variables based on Theme === */
    html[data-theme='light'] {
        --current-bg: var(--light-bg);
        --current-card-bg: var(--light-card-bg);
        --current-text-primary: var(--light-text);
        --current-text-secondary: var(--light-text-secondary);
        --current-border-color: var(--light-border-color);
    }
    html[data-theme='dark'] {
        --current-bg: var(--dark-bg);
        --current-card-bg: var(--dark-card-bg);
        --current-text-primary: var(--dark-text);
        --current-text-secondary: var(--dark-text-secondary);
        --current-border-color: var(--dark-border-color);
    }
    
    /* === CARD DESIGN === */
    .data-container {
        background-color: var(--current-card-bg);
        border: 1px solid var(--current-border-color);
        border-radius: 16px;
        padding: 25px;
        position: relative;
        overflow: hidden;
    }
    .data-container::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: var(--gradient-pink);
        filter: blur(8px);
    }
    
    /* === TABLE HEADER === */
    .table-header {
        display: flex; flex-wrap: wrap; justify-content: space-between;
        align-items: center; gap: 1rem; margin-bottom: 1.5rem;
    }
    .table-header h1 {
        font-weight: 600; font-size: 1.8rem;
        color: var(--current-text-primary);
        margin: 0;
    }

    /* === MODERN TABLE STYLING === */
    .table { color: var(--current-text-primary); border-color: var(--current-border-color); margin-bottom: 0; }
    .table thead th { border: 0; text-transform: uppercase; font-size: 0.8rem; color: var(--current-text-secondary); padding-top: 0; padding-bottom: 1rem; }
    .table tbody tr { border-bottom: 1px solid var(--current-border-color); transition: background-color 0.2s ease; }
    .table tbody tr:last-child { border-bottom: 0; }
    html[data-theme='dark'] .table tbody tr:hover { background-color: rgba(255, 255, 255, 0.03); }
    html[data-theme='light'] .table tbody tr:hover { background-color: rgba(0, 0, 0, 0.03); }
    .table td, .table th { border-top: none; vertical-align: middle; }
    
    .sender-info { display: flex; align-items: center; gap: 1rem; }
    .sender-avatar { width: 40px; height: 40px; border-radius: 50%; background-color: var(--accent-blue); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 600; text-transform: uppercase; }
    
    .message-details strong { color: var(--current-text-primary); }
    .message-details .message-body {
        max-width: 400px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: var(--current-text-secondary);
        font-size: 0.9rem;
    }

    .message-col {
        max-width: 300px; /* Aap isay apni marzi se adjust kar sakte hain */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>

<div class="data-container">

    <div class="table-header">
        <h1>Contact Form Messages</h1>
        {{-- Search bar yahan add kar sakte hain, فی الحال simple rakha hai --}}
    </div>
    
    <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Received At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $message)
            <tr>
                {{-- # Column --}}
                <td>{{ $loop->iteration }}</td>
                
                {{-- Name Column --}}
                <td>{{ $message->name }}</td>
                
                {{-- Email Column --}}
                <td>{{ $message->email }}</td>
                
                {{-- Subject Column --}}
                <td>{{ $message->subject }}</td>
                
                {{-- Message Column --}}
                <td class="message-col" title="{{ $message->message }}">
                    {{ $message->message }}
                </td>
                
                {{-- Received At Column --}}
                <td class="text-nowrap">{{ $message->created_at->format('d M, Y h:i A') }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No contact messages found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
    
    {{-- Pagination yahan add kar sakte hain --}}

</div>

@endsection