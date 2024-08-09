@push('css-page')
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
@endpush
@extends('layouts.admin')
@section('page-title')
    {{ __('File Manager') }}
@endsection
{{-- @section('action-btn')
    <div class="float-end">
        <a href="{{ route('sheet.create') }}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection --}}
@section('content')
    <div class="row">
        <div id="fm" style="height: 600px;"></div>
    </div>
@endsection
@push('script')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>

    </script>
@endpush