@extends('layout.app')

@section('title')
    <h3>Entrevistas</h3>
    <p class="text-subtitle text-muted">Gerenciamento de entrevistas do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('entrevistas.index') }}">Entrevistas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalhes
        </li>
    </ol>
@endsection

@section('conteudo')


@include('entrevistas.partials.show.card-corpo')

@include('entrevistas.partials.show.card-corpo-adicional')

@if($entrevista->obito_fetal == 1)
@include('entrevistas.partials.show.card-obito-fetal')
@endif

@include('entrevistas.partials.show.card-outros-detalhes')

@if($entrevista->digitador_id != null && Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Digitador'))
@include('entrevistas.partials.show.card-escrivao')
@endif

@endsection