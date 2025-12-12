@extends('layout.app')

@section('title')
    <h3>Laudos</h3>
    <p class="text-subtitle text-muted">Gerenciamento de laudos do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('laudos.index') }}">Laudos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalhes
        </li>
    </ol>
@endsection

@section('conteudo')
    @include('laudos.partials.show.card-corpo')

    
    @if ($laudo->historicoLaudo->isNotEmpty())
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                    aria-controls="home" aria-selected="true">Informações</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Alterações</a>
            </li>
        </ul>
    @endif

    <div class="tab-content my-4" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            @if ($laudo->historico != null)
                @include('laudos.partials.show.card-historico')
            @endif

            @include('laudos.partials.show.card-exames')

            @include('laudos.partials.show.card-causas-morte')

            @include('laudos.partials.show.card-escrivao')
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            @include('laudos.partials.show.card-alteracoes')
        </div>

    </div>
@endsection
