@extends('templates.master')

@section('title', 'Pemilu')
@section('pwd', 'Pemilu')
@section('sub-pwd', 'Pemilu')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="row render">
    {{--  --}}
</div>
@endsection

@push('script')
    <script src="{{asset('functions/pemilu/main.js')}}"></script>
@endpush