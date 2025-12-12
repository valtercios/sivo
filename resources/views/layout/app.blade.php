<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIVO</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link rel="shortcut icon" href="{{ asset('assets/images/logodegradesemfundo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/images/logodegradesemfundo.png') }}" type="image/png">
    <style>
        .swal2-styled.swal2-confirm {
            margin: 0px 10px;
        }

        .choices[data-type*="select-one"] select.choices__input {
            display: block !important;
            opacity: 0;
            pointer-events: none;
            position: absolute;
            left: 0;
            bottom: 0;
        }

        .choices.is-disabled {
            border: none !important;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    @yield('css')

</head>

<body class="{{ !Session::get('isdark') ? 'theme-light' : 'theme-dark' }}"
    style="color-scheme:{{ !Session::get('isdark') ? 'none' : 'dark' }};">
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="{{ route('dashboard.index') }}"><img
                                    src="{{ asset('assets/images/logo-sivo-sem-fundo.png') }}" alt=""
                                    width="110px" style="height: 70px !important;"></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                    {{ Session::get('isdark') ? 'checked' : '' }}>
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    @include('layout.partials.sidebar')
                </div>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            @include('layout.partials.navbar')
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                @yield('title')
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    @yield('breadcrumbs')
                                </nav>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        @yield('conteudo')
                    </section>
                </div>
                <div vw class="enabled">
                    <div vw-access-button class="active"></div>
                    <div vw-plugin-wrapper>
                        <div class="vw-plugin-top-wrapper"></div>
                    </div>
                </div>
                <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
                <script>
                    new window.VLibras.Widget('https://vlibras.gov.br/app');
                </script>

                @include('layout.partials.footer')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/sivo.js') }}"></script>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/jquery/jquery.smartresizeandscroll.js') }}"></script>
    <script src="{{ asset('assets/extensions/tinymce/tinymce.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Inicializar os tooltips --}}

    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.validar-form')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                            toastr.error("Preencha todos os campos obrigatórios!");
                            $('select[class*="choices"][required]:not([disabled])').on('change',
                                function() {
                                    let valorSelect = $(this).val();
                                    $(this).parent().parent()[0].style.borderRadius = "5px";
                                    if (valorSelect != 0 && valorSelect != "") {
                                        $(this).parent().parent()[0].style.border = "1px solid #198754";
                                    } else {
                                        $(this).parent().parent()[0].style.border = "1px solid #dc3545";
                                    }
                                });
                            $('select[class*="choices"][required]:not([disabled])').change();
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        // If you want to use tooltips in your project, we suggest initializing them globally
        // instead of a "per-page" level.
        $('#notificationsCountBadge').hide();
        document.addEventListener(
            "DOMContentLoaded",
            function() {
                var tooltipTriggerList = [].slice.call(
                    document.querySelectorAll('[data-bs-toggle="tooltip"]')
                );
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            },
            false
        );
        let themeSwitch = document.querySelector("#toggle-dark");
        themeSwitch.addEventListener("change", function() {
            let item = this;
            fetch('{{ route('alterar.tema') }}')
                .then(function() {})
                .catch(function(err) {

                });
        });
        $('input[name*="cpf"]').mask('000.000.000-00', {
            reverse: true
        });
        $('input[name*="cep"]').mask('00000-000');
        $('input[name*="rg"]').keyup(function() {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.-]/g, '');
            }
            if (val.length > 25) {
                val = val.substr(0, 25);
            }
            $(this).val(val);
        });
        $('input[name*="num_documento"], input[name*="novo_cbo_mae"], input[name*="novo_cbo_corpo"]').keyup(function() {
            var val = $(this).val();
            val = val.toUpperCase(); // Converte todas as letras para maiúsculas
            if (val.length > 25) {
                val = val.substr(0, 25);
            }
            $(this).val(val);
        });
        var telephoneMask = function(val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(telephoneMask.apply({}, arguments), options);
                }
            };

        $('input[name*="telefone"]').mask(telephoneMask, spOptions);

        //notifications count function
        function notificacoes() {
            axios.get('{{ route('notificacoes.countnotifications') }}')
                .then(function(response) {
                    if (response.data.count > 0) {
                        $('#notificationsCountBadge').html(response.data.count);
                        $('#notifications-list').html("");
                        $('#notificationsCountBadge').show();
                        $.each(response.data.notifications, function(index, value) {
                            if (index == 5) {
                                return false;
                            }
                            $('#notifications-list').append(
                                `
                                <!-- NOTIFICATION ITEM -->
                                <li class="dropdown-item notification-item">
                                    <a class="d-flex align-items-center" href="#">
                                        <div class="notification-icon bg-${value.data.type}">
                                            <i class="${value.data.icon}" style="font-size: 25px;"></i>
                                        </div>
                                        <div class="notification-text ms-4">
                                            <p class="notification-title ${!value.read_at ? 'font-bold' : ''}">${value.data.title}</p>
                                            <p class="notification-subtitle font-thin text-sm">${value.data.subtitle}</p>
                                        </div>
                                    </a>
                                </li>
                                <!-- FIM NOTIFICATION ITEM -->
                                `
                            );
                        });

                    } else {
                        $('#notificationsCountBadge').html('');
                        $('#notifications-list').html("");
                        $('#notificationsCountBadge').hide();
                        if (response.data.notifications.length > 0) {
                            $.each(response.data.notifications, function(index, value) {
                                if (index == 5) {
                                    return false;
                                }
                                $('#notifications-list').append(
                                    `
                                <!-- NOTIFICATION ITEM -->
                                <li class="dropdown-item notification-item">
                                    <a class="d-flex align-items-center" href="#">
                                        <div class="notification-icon bg-${value.data.type}">
                                            <i class="${value.data.icon}" style="font-size: 25px;"></i>
                                        </div>
                                        <div class="notification-text ms-4">
                                            <p class="notification-title ${!value.read_at ? 'font-bold' : ''}">${value.data.title}</p>
                                            <p class="notification-subtitle font-thin text-sm">${value.data.subtitle}</p>
                                        </div>
                                    </a>
                                </li>
                                <!-- FIM NOTIFICATION ITEM -->
                                `
                                );
                            });
                        } else {
                            $('#notifications-list').append(
                                `
                                <!-- NOTIFICATION ITEM -->
                                <li class="dropdown-item notification-item">
                                    <a class="d-flex align-items-center" href="#">
                                        <div class="notification-text ms-4">
                                            <p class="notification-title font-bold">Nenhuma notificação</p>
                                        </div>
                                    </a>
                                </li>
                                <!-- FIM NOTIFICATION ITEM -->
                                `
                            );
                        }

                    }
                })
                .catch(function(error) {

                });
        }
        notificacoes();
        setInterval(notificacoes, 60000);
    </script>

    @yield('js')

</body>

</html>