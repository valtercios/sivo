@extends('layout.app')

@section('title')
    <h3>Declaração de óbito</h3>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Declaração de óbito
        </li>
</ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css')}}">
    
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body" style="padding-left: 30px;">
            @include('declaracao-obito.dados')
        </div>
    </div>
    {{-- @include('usuarios.permissoes.partials.modal-criar-permissao') --}}
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js')}}"></script>
@endsection








