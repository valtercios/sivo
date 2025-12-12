@extends('layout.app')

@section('title')
    <h3>Alterar senha</h3>
    <p class="text-subtitle text-muted">Altere sua senha preenchendo os campos abaixo</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Alterar senha
    </li>
</ol>
@endsection

@section('conteudo')
   
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Alterar Senha</h4>
            <p class="text-subtitle text-muted">Preencha os campos abaixo</p>
        </div>
        <div class="card-body">
            <form action="{{ route('perfil.updatepassword') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group has-icon-left">
                            <label for="senha_atual">Senha atual</label>
                            
                            <div class="position-relative">
                                <input type="password" required id="senha_atual" class="form-control" placeholder="Informe a senha atual" name="senha_atual">
                                <div class="form-control-icon">
                                    <i class="bi bi-lock-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="novasenha">Nova senha</label>
                            
                            <div class="position-relative">
                                <input type="password" id="novasenha" class="form-control" placeholder="Informe a nova senha" name="novasenha">
                                <div class="form-control-icon">
                                    <i class="bi bi-lock-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="novasenha_confirmar">Confirmar nova senha</label>
                            
                            <div class="position-relative">
                                <input type="password" id="novasenha_confirmar" class="form-control" placeholder="Confirme a nova senha" name="novasenha_confirmar">
                                <div class="form-control-icon">
                                    <i class="bi bi-lock-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1 ">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection



