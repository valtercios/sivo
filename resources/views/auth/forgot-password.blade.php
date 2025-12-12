<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIVO - ESQUECI A SENHA</title>
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
                <li class="col" id="sabdp"><i class="fas fa-list-alt"></i> SISTEMA DE INFORMAÇÃO DE VERIFICAÇÃO DE ÓBITO
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <section class="img">
            <img src="{{ asset('assets/images/logogov.jpg') }}">
            <h4>SISTEMA DE INFORMAÇÃO DE VERIFICAÇÃO DE ÓBITO</h4>
        </section>
        <section class="login-content">
            <div id="adianti_div_content_recuperar">
                <div class="card-header text-center">
                    <p style="font-size: 25px;"><b>Redefinir </b>senha</p>
                </div>
                <div class="card-body ">
                    <form action="{{ route('password.request') }}" method="POST" class="formRecu">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-envelope" aria-hidden="true"></i>
                                </div>
                            </div :value="__('Email')">
                            <input type="email" class="form-control" name="email" placeholder="E-mail"
                                :value="old('email')" autofocus>
                        </div>
                        <button class="btn btn-info btn-block formRecu" type="submit"><i class="fa fa-paper-plane"
                                style=";padding-right:4px"></i>ENVIAR</button>
                        @if (!empty($msg))
                            <div class="warning">
                                {{ $msg }}
                            </div>
                        @endif
                        <hr>
                        <footer class="mt-2 col-auto" id="voltarRecuperar">
                            <div class="row card-shadow align-items-center">
                                <p><a href="{{ route('login') }}" title="Voltar a tela de login"></title><i
                                            class="far fa-arrow-alt-circle-left"></i> Voltar</a></p>
                            </div>
                        </footer>
                    </form>
                </div>
            </div>
        </section>
        <footer class="mt-5 pt-3 fixed-bottom rodape">
            <ul class="d-flex justify-content-center pb-3 pr-3 text-white">
                <li class="mx-auto">
                    <a href="{{ 'http://gti.saude.rn.gov.br/' }}" target="_blank" title="Visitar site da UGTSIC">
                        <img src="{{ asset('assets/images/ugtsiclogob.png') }}" class="mx-3 ugtsic" width="32"
                            height="39" alt="logo ugtsic" />
                    </a>
                    <img src="{{ asset('assets/images/logo-gov.png') }}" class="mx-3 gov" width="47" height="39"
                        alt="logo do RN" />
                    Sistema desenvolvido por
                    <a href="http://gti.saude.rn.gov.br/" target="_blank" title="Visitar site da UGTSIC" id="linkUgtsic">
                        UGTSIC
                    </a> - SESAP
                </li>
                <li class="ml-2 align-self-center">
                    Versão: 1.0.0 </li>
            </ul>
        </footer>
    </div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
    integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
