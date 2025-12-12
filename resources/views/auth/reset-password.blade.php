<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Indicadores</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/8f51c191f1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <script>
        function showToast(toastType, toastTitle, toastMsg) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: true,
                confirmButtonColor: '#204065',
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                title: toastTitle,
                text: toastMsg,
                icon: toastType
            })
        }
    </script>
</head>

<body>
    <header>
        <nav>
            <ul class="container">
                <li class="col" id="sesap"> SESAP - SECRETARIA DE SAÚDE PÚBLICA DO RN</li>
                <li class="col" id="sabdp"><i class="fas fa-list-alt"></i> SISTEMA DE INDICADORES DE MATERIAIS HOSPITALARES
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <section class="img">
            <img src="{{ asset('assets/imagens/logogov.jpg') }}">
            <h4>SISTEMA DE INDICADORES DE MATERIAIS HOSPITALARES</h4>
        </section>
        <section class="login-content">
            <div id="adianti_div_content_recuperar">
                <div class="card-header text-center">
                    <p style="font-size: 25px;"><b>Redefinir </b>senha</p>
                </div>
                <div class="card-body ">
                    <!-- Validation Errors -->

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <script>
                                showToast('error', 'Algo deu errado!', '{{ $error }}')
                            </script>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('password.update') }}" class="formRecu">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope" aria-hidden="true"></i>
                                </div>
                            </div :value="__('Email')">
                            <input type="email" class="form-control" name="email" placeholder="E-mail"
                                :value="old('email')" autofocus>
                        </div>

                        <!-- Password -->
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Senha"
                                :value="{{ old('password') }}" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Confirmar Senha" :value="{{ old('password_confirmation') }}" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block" name="btn-acessar"><i
                                    class="fa fa-save mr-1"></i> RECUPERAR</button>
                        </div>

                    </form>
