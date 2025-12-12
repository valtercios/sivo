@extends('layout.app')

@section('title')
    <h3>Funerárias</h3>
    <p class="text-subtitle text-muted">Gerenciamento de funerárias do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('funerarias.index') }}">Funerárias</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nova funerária
        </li>
    </ol>
@endsection

@section('conteudo')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cadastrar funerária</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('funerarias.store') }}" method="POST">
                @method('post')
                @csrf
                @include('funerarias.formCria')

                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('funerarias.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Cadastrar</button>

                </div>
            </form>
        </div>
    </div>
@endsection

