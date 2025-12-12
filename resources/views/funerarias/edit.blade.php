@extends('layout.app')

@section('title')
    <h3>Funerárias</h3>
    <p class="text-subtitle text-muted">Gerenciamento de funerárias do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('funerarias.index') }}">Funerárias</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar funerária
        </li>
    </ol>
@endsection

@section('conteudo')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Editar funerária</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('funerarias.update', ['id'=>$funeraria->id]) }}" method="POST">
                @method('PUT')
                @csrf
                @include('funerarias.formEdita')

                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('funerarias.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Salvar</button>

                </div>
            </form>
        </div>
    </div>
@endsection

