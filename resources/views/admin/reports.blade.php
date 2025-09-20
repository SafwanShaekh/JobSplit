@extends('admin.layouts.app')

@section('content')
<h1>Download Reports</h1>
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="list-group">
    <a href="{{ route('admin.reports.download', ['type' => 'users']) }}" class="list-group-item list-group-item-action">Download Users Report</a>
    <a href="{{ route('admin.reports.download', ['type' => 'jobs']) }}" class="list-group-item list-group-item-action">Download Jobs Report</a>
    <a href="{{ route('admin.reports.download', ['type' => 'complaints']) }}" class="list-group-item list-group-item-action">Download Complaints Report</a>
</div>
@endsection