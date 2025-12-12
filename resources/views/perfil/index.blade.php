@extends('layout.app')

@section('title')
    <h3>Perfil</h3>
    <p class="text-subtitle text-muted">Informações do perfil</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Perfil
    </li>
</ol>
@endsection

@section('conteudo')
   
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Detalhes do perfil</h4>
            
        </div>
        <div class="card-body row">
            <div class="col-5 text-center d-flex align-items-center justify-content-center">
                <div class="">
                    @if($perfil->image)
                        <img src="{{ baseImage64('storage/'.$perfil->image) }}" class="rounded-circle" width="150" height="150" alt="...">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" width="200px" class="avatar" alt="{{$perfil->name}}" style="max-width: 50%">
                    @endif
                    <h2><strong>{{ $perfil->name ?? 'Sem Nome Cadastrado' }}</strong></h2>
                    <p class="lead mb-5">{{ $perfil->username }}<br>
                        {{ $perfil->email }}
                    </p>
                </div>
            </div>
            <div class="col-7">
                <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Login</label>
                        <input type="text" id="inputLogin" name="name" class="form-control"
                            value="{{ $perfil->username ?? '' }}" disabled />
                    </div>
                    <div class="form-group">
                        <label for="inputName">Nome do Usuário</label>
                        <input type="text" id="inputName" name="name" class="form-control"
                            value="{{ $perfil->name ?? '' }}" />
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">E-mail</label>
                        <input type="email" id="inputEmail" name="email" class="form-control"
                            value="{{ $perfil->email ?? '' }}" />
                    </div>

                    <div class="form-group">
                        <label for="inputEmail">Foto de perfil</label>
                        <input type="file" id="inputFile" name="image" class="form-control"
                            value="{{ $perfil->email ?? '' }}" />
                    </div>
                    <button type="submit" class="btn btn-sm icon icon-left btn-success">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection






