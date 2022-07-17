@extends('templates.master')

@section('title', 'Voting')
@section('pwd', 'Voting')
@section('sub-pwd', 'Voting')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="row">
    <div class="alert alert-warning">
        <i class="fa fa-exclamation-triangle"></i>
        <strong>Pastikan pilihan anda benar, pemilihan tidak dapat di ulang!</strong>
    </div>
    @forelse ($kandidat as $kandidat)
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <span>
                        <h4><strong>No. {{$loop->iteration}} - {{$kandidat->user->nama}}</strong></h4>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <img src="{{asset($kandidat->user->foto)}}" class="img-fluid">
            </div>
            <div class="card-body card-visi-misi visi-misi{{$kandidat->id_kandidat}}">
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-center"><strong>Visi</strong></h4>
                        <span>
                            "<i>{{json_decode($kandidat->visi_misi)->visi}}</i>"
                        </span>
                    </div>
                    <div class="col-6">
                        <h4 class="text-center"><strong>Misi</strong></h4>
                        <span>
                            @foreach (json_decode($kandidat->visi_misi)->misi as $misi)
                                {{$loop->iteration}}. {{$misi->misi}} <br>
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <button class="btn btn-info btn-visi-misi btn-show{{$kandidat->id_kandidat}}" data-id="{{$kandidat->id_kandidat}}">
                        <i class="fe fe-info"></i>
                        <span>Visi Misi</span>
                    </button>
                    <button class="btn btn-success btn-vote" data-id="{{$kandidat->id_kandidat}}">
                        <i class="fe fe-check-circle"></i>
                        <span>Pilih</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-warning">
        <i class="fa fa-exclamation-triangle"></i>
        <strong>Tidak ada data calon kandidat</strong>
    </div>
    @endforelse
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('.card-visi-misi').hide();

            $('button.btn-visi-misi').click(function () {
                var id = $(this).data('id');
                $('.visi-misi'+id).toggle(function () {
                    if ($(this).is(':visible')) {
                        $('button.btn-show'+id).html('<i class="fe fe-eye-off"></i> <span>Sembunyikan</span>');
                    } else {
                        $('button.btn-show'+id).html('<i class="fe fe-info"></i> <span>Visi Misi</span>');
                    }
                });
            });
        });
    </script>
@endpush