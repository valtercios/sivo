<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIVO - LOGIN</title>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="shortcut icon" href="{{ asset('assets/images/logodegradesemfundo.png') }}" type="image/png">
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
                <li class="col" id="sabdp"><i class="fas fa-list-alt"></i> SIVO</li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <section>
            <figure class="img">
                <img src="{{ asset('assets/images/logo-sivo.jfif') }}" style="width: 350px !important;">
                <h4>SISTEMA DE INFORMAÇÃO DE VERIFICAÇÃO DE ÓBITO</h4>
            </figure>
        </section>
        <section class="login-content">
            <div id="adianti_div_content">
                <header class="card-header text-center">
                    <p> Sistema de autenticação <b>SESAP</b></p>
                </header>
                <div class="card-body">

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <script>
                                showToast('error', 'Algo deu errado!', '{{ $error }}')
                            </script>
                        @endforeach
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="identity" placeholder="Informe seu CPF"
                                :value=" old('cpf')" required autofocus>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </span>
                            </div>
                            <input type="password" class="form-control" id="password" :value="{{ old('Password') }}"
                                name="password" placeholder="Senha" required autocomplete="current-password">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="remember" class="form-check-input" style="margin-top:0.4em;"
                                id="manter">
                            <label class="form-check-label" name="remember">{{ __('Lembre me') }}</label>
                        </div>
                        <button type="submit" class="btn btn-info btn-block">
                            <i class="fas fa-sign-in-alt mr-1"></i>
                            {{ __('Entrar') }}
                        </button>
                        <hr>
                        <?php $_SESSION['msg'] = ''; ?>
                        <?php if (!empty($msg)) : ?>
                        <div class="warning">
                            <?= $msg ?>
                        </div>
                        <?php endif; ?>
                        <footer class="mt-3 form-group text-center">
                            <div class="row card-shadow">
                                <span><a href="{{ route('password.request') }}" id="redefinir"
                                        title="Redefinir a senha"><i class="fas fa-eraser" aria-hidden="true"></i>
                                        Redefinir senha</a></span>
                            </div>
                        </footer>
                    </form>
                </div>
            </div>
            </div>
        </section>
    </main>
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
</body>
<script src="{{ asset('assets/js/extensions/jquery.mask.min.js') }}"></script>
<script>
    function validaCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf == '') return false;
        // Elimina CPFs invalidos conhecidos	
        if (cpf.length != 11 ||
            // cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito	
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito	
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10)))
            return false;
        return true;
    }
    $(document).ready(function() {
        $("form").submit(function(e) {
            let cpfElemento = $('input[name="identity"]').val().replace('.', '').replace('-', '')
                .replace('.', '');
            if (validaCPF(cpfElemento)) {
                $(this).submit();
            } else {
                showToast('error', 'Algo deu errado!', 'O CPF informado não é valido!')
                e.preventDefault();
                return false
            }
        })
        $('input[name="identity"]').mask('000.000.000-00', {
            reverse: true
        });
    });
</script>

</html>
