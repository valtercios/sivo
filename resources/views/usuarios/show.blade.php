@extends('adminlte::page')

@section('title', 'UGTSIC - USUÁRIOS')

@section('content')
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> USUÁRIOS</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Login:</strong>
                            {{ $user->username }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Roles:</strong>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $papeis)
                                    <label class="badge badge-success">{{ $papeis }}</label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Limite de Processos:</strong>
                            {{ $user->processos_view }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Cadastrado por:</strong>
                            {{ $user->criado->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Editado por:</strong>
                            {{ $user->editado->name ?? 'Sem Edição'}}
                        </div>
                    </div>
                    

                </div>
                <div class="card-footer">
                  <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Voltar</a>
            </div>

    </section>
@stop

@section('css')

@stop

@section('js')
@stop
