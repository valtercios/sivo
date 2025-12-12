@extends('layout.app')

@section('title')
    <h3>Exames</h3>
    <p class="text-subtitle text-muted">Gerenciamento de exames do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('exames.index') }}">Exames</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalhes do exame
        </li>
    </ol>
@endsection

@section('conteudo')
    
    @include('exames.partials.show.card-detalhes')


    @if($exame->respondido_por && ($exame->respondido_por == auth()->user()->id || $exame->solicitado_por == auth()->user()->id))
        @include('exames.partials.show.card-resposta')
    @endif

@endsection

