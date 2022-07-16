@extends('templates.master')

@section('title', 'Anggota')
@section('pwd', 'Anggota')
@section('sub-pwd', 'Anggota')
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
    <script src="{{asset('functions/anggota/main.js')}}"></script>
@endpush