@extends('templates.master')

@section('title', 'Data ST. Eka Purwa Kanthi')
@section('pwd', 'ST. Eka Purwa Kanthi')
@section('sub-pwd', 'ST. Eka Purwa Kanthi')
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