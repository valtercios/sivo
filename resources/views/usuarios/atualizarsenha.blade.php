<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIVO - Atualizar Cadastro</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logodegradesemfundo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/images/logodegradesemfundo.png') }}" type="image/png">
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block text-center">
            {{-- <a href="index.html"><i class="bi bi-chevron-left"></i></a> --}}
            <a class="ms-4" href="index.html">
                <img src="{{ baseImage64('assets/images/logo-sivo-sem-fundo.png') }}" width="150px">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Primeiro Acesso</h4>
            </div>
            <div class="card-body">
                <p>Bem-vindo ao sistema, como é seu primeiro acesso é necessário que você realize a mudança da sua senha
                    para uma melhor segurança! Basta preencher os campos abaixo e confirmar.</p>
                <form action="{{ route('usuarios.atualizarsenha') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="senha_atual">Senha atual</label>

                                <div class="position-relative">
                                    <input type="password" required id="senha_atual" class="form-control"
                                        placeholder="Informe a senha atual" name="senha_atual">
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
                                    <input type="password" id="novasenha" class="form-control"
                                        placeholder="Informe a nova senha" name="novasenha">
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
                                    <input type="password" id="novasenha_confirmar" class="form-control"
                                        placeholder="Confirme a nova senha" name="novasenha_confirmar">
                                    <div class="form-control-icon">
                                        <i class="bi bi-lock-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">

                            <button type="button" id="sair-btn" class="btn btn-secondary me-1 mb-1" href="#"> Cancelar</button></li>
                            <button type="submit" class="btn btn-primary me-1 mb-1 ">Salvar</button>
                        </div>
                    </div>
                </form>

                <form action="{{ route('logout2') }}" method="post" id="sair-form">
                    @csrf
                </form>
            </div>
        </div>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    $('#sair-btn').on('click', function(){
        $('#sair-form').submit();
    })
</script>
</html>
