@extends('templates.master')

@section('title', 'Kandidat')
@section('pwd', 'Kandidat')
@section('sub-pwd', 'Kandidat')
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
<script src="https://spruko.com/demo/sash/sash/assets/plugins/select2/select2.full.min.js"></script>
    <script src="{{asset('functions/kandidat/main.js')}}"></script>
@endpush