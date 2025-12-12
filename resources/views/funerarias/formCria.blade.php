<div class="row">
    <div class="col-md-12 col-12">
        <div class="form-group has-icon-left ">
            <label for="nome">Nome da funerária</label>
            <div class="position-relative">
                <input type="text" id="nome" class="form-control" placeholder="Nome da funerária" name="nome">
                <div class="form-control-icon">
                    <i class="bi bi-grid-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="cep">CEP</label>
            
            <div class="position-relative">
                <input type="text" id="cep" class="form-control" placeholder="CEP" name="cep"
                onblur="pesquisacep(this.value);" >
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="logradouro">Logradouro</label>
            
            <div class="position-relative">
                <input type="text" id="logradouro" class="form-control" placeholder="Logradouro" name="logradouro">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="form-group has-icon-left">
            <label for="numero">Número</label>
            <div class="form-group">
                <div class="position-relative">
                    <input type="text" id="numero" class="form-control" placeholder="Número" name="numero">
                    <div class="form-control-icon">
                        <i class="bi bi-list-ol"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="form-group has-icon-left">
            <label for="complemento">Complemento</label>
            <div class="form-group">
                <div class="position-relative">
                    <input type="text" id="complemento" class="form-control" placeholder="Complemento" name="complemento">
                    <div class="form-control-icon">
                        <i class="bi bi-card-list"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="bairro">Bairro</label>
            <div class="form-group">
                <div class="position-relative">
                    <input type="text" id="bairro" class="form-control" placeholder="Bairro" name="bairro">
                    <div class="form-control-icon">
                        <i class="bi bi-card-list"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="cidade">Cidade</label>
            <div class="form-group">
                <div class="position-relative">
                    <input type="text" id="cidade" class="form-control" placeholder="Cidade" name="cidade">
                    <div class="form-control-icon">
                        <i class="bi bi-card-list"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="estado">Estado</label>
            <div class="form-group">
                <div class="position-relative">
                    <input type="text" id="estado" class="form-control" placeholder="Estado" name="estado">
                    <div class="form-control-icon">
                        <i class="bi bi-card-list"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@section('js')

@include('funerarias.partials.pesquisa-cep')

@endsection