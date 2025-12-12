@extends('layout.app')

@section('title')
    <h3>Corpos</h3>
    <p class="text-subtitle text-muted">Gerenciamento dos corpos do SVO</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('corpos.index') }}">Corpos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar corpo
        </li>
    </ol>
@endsection

@section('conteudo')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('corpos.update', $corpo->id) }}" method="POST" class="needs-validation" novalidate id="meuFormulario">
        @method('post')
        @csrf
        <input type="hidden" name="responsavel_corpo_id" value="{{ $corpo->responsavel_corpo_id ?? 0 }}">
        <input type="hidden" name="responsavel_entrega_id" value="{{ $corpo->responsavel_entrega_id ?? 0 }}">
        @include('corpos.formEdita')

        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('corpos.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
            <button type="submit" class="btn btn-primary me-1 mb-1">Salvar</button>
        </div>
        @include('corpos.partials.modal.justificativa')
    </form>
    @include('utils.modals.modal-pesquisa-cep-endereco')
@endsection

@section('js')
    @include('utils.choices')
    <script>
        choicesFunerarias = new Choices(document.querySelector('#funeraria-select'));
        choicesFunerariaRetirada = new Choices(document.querySelector('#funeraria-retirada-select'));
    </script>
    <script src="{{ asset('js/corpos/cadastro.js') }}"></script>

    <script>
        // Validação do formulário antes de enviar
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                            toast.error("Preencha todos os campos obrigatórios!");

                            $('html, body').animate({
                                scrollTop: 0
                            }, 200);
                            
                            form.classList.add('was-validated');
                            return false;
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    <script>
        choiceOrgaoEmissorCorpo = new Choices(document.querySelector('select[name="orgao_emissor_corpo"]'));
        choiceOrgaoEmissorResponsavelCorpo = new Choices(document.querySelector(
            'select[name="orgao_emissor_responsavel"]'));
        choiceEstadoRGResponsavelCorpo = new Choices(document.querySelector('select[name="estado_rg_responsavel_corpo"]'));
        choicesEstadoRGCorpo = new Choices(document.querySelector('select[name="estado_rg"]'));
        $('select[name="local_obito"]').change();
        $(document).ready(function() {
            $("#cadastro-responsavel-corpo").show();
            $("#cadastro-responsavel-corpo-info-adicional").hide();
        });
    </script>
    <script>
        // Habilitar/Desabilitar campos de RG baseado no tipo de documento
        var tipoDocumento = '{{ $corpo->tipo_documento }}';

        function atualizarCamposDocumentoEdit() {
            let tipo = $('#tipo_documento').val();
            console.log('Tipo de documento:', tipo);
            let rg_corpo_input = $('#rg_corpo');
            let orgao_emissor_input = $('select[name="orgao_emissor_corpo"]');
            let estado_rg_input = $('select[name="estado_rg"]');
            let rg_div = $('#div_rg_corpo');
            let orgao_div = $('#div_orgao_emissor_corpo');
            let uf_div = $('#div_uf_corpo');

            if (tipo === 'RG') {
                console.log('Setando como RG - adicionando required');
                rg_div.removeClass('d-none');
                orgao_div.removeClass('d-none');
                uf_div.removeClass('d-none');
                rg_corpo_input.prop('required', true);
                orgao_emissor_input.prop('required', true);
                estado_rg_input.prop('required', true);
                console.log('RG required:', rg_corpo_input.prop('required'));
                choiceOrgaoEmissorCorpo.enable();
                choicesEstadoRGCorpo.enable();
            } else {
                console.log('Não é RG - removendo required');
                rg_div.addClass('d-none');
                orgao_div.addClass('d-none');
                uf_div.addClass('d-none');
                rg_corpo_input.prop('required', false);
                orgao_emissor_input.prop('required', false);
                estado_rg_input.prop('required', false);
                choiceOrgaoEmissorCorpo.disable();
                choicesEstadoRGCorpo.disable();
            }
        }

        // Executar na carga
        $(document).ready(function() {
            console.log('Document ready - chamando atualizarCamposDocumentoEdit');
            atualizarCamposDocumentoEdit();
        });

        // Executar quando mudar
        $('#tipo_documento').on('change', function() {
            console.log('Tipo documento mudou');
            atualizarCamposDocumentoEdit();
        });
    </script>
    <script>
        $('input').keyup(function() {
            var $input = $(this);
            var start = $input[0].selectionStart;
            var end = $input[0].selectionEnd;
            var upper = $input.val().toUpperCase();
            $input.val(upper);
            $input[0].setSelectionRange(start, end);
        });
        $('#nao_possui_cpf').change(function() {
            let valueCheckBox = $(this).is(':checked');
            if (valueCheckBox) {
                $('input[name="cpf_corpo"]').attr('disabled', true);
            } else {
                $('input[name="cpf_corpo"]').attr('disabled', false);
            }
        });
        $('#natimorto').change(function() {
            let valueCheckBox = $(this).is(':checked');
            if (valueCheckBox) {
                $('input[name="data_nascimento"]').attr('disabled', true);
            } else {
                $('input[name="data_nascimento"]').attr('disabled', false);
            }
        });
        $('#nao_possui_rg').change(function() {
            let valueCheckBox = $(this).is(':checked');
            if (valueCheckBox) {
                $('input[name="rg_corpo"]').attr('disabled', true);
                $('input[name="orgao_emissor_corpo"]').attr('disabled', true);
                $('input[name="estado_rg"]').attr('disabled', true);
                choiceOrgaoEmissorCorpo.disable();
                choicesEstadoRGCorpo.disable();
            } else {
                $('input[name="rg_corpo"]').attr('disabled', false);
                $('input[name="orgao_emissor_corpo"]').attr('disabled', false);
                $('input[name="estado_rg"]').attr('disabled', false);
                choiceOrgaoEmissorCorpo.enable();
                choicesEstadoRGCorpo.enable();
            }
        });

        $('#estrangeiro').change(function() {
            let valueCheckBox = $(this).is(':checked');
            if (valueCheckBox) {
                $('input[name="nacionalidade"]').attr('disabled', false);
                $('input[name="endereco_postal_corpo"]').attr('disabled', false);
                $('input[name="cep_corpo"]').attr('disabled', true);
            } else {
                $('input[name="nacionalidade"]').attr('disabled', true);
                $('input[name="endereco_postal_corpo"]').attr('disabled', true);
                $('#cep_corpo').attr('disabled', false);

            }
        });
        $('#responsavel_estrangeiro').change(function() {
            let valueCheckBox = $(this).is(':checked');
            if (valueCheckBox) {
                $('input[name="nacionalidade_responsavel"]').attr('disabled', false);
            } else {
                $('input[name="nacionalidade_responsavel"]').attr('disabled', true);
            }
        });
        $('#responsavel_estrangeiro_2').change(function() {
            let valueCheckBox = $(this).is(':checked');
            if (valueCheckBox) {
                $('input[name="nacionalidade_responsavel_2"]').attr('disabled', false);
            } else {
                $('input[name="nacionalidade_responsavel_2"]').attr('disabled', true);
            }
        });

        $('input[name*="rg"]').keyup(function() {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.-]/g, '');
            }
            if (val.length > 15) {
                val = val.substr(0, 15);
            }
            $(this).val(val);
        });
        $('#cadastrar-funeraria-btn').on('click', novaFuneraria);

        $('#transporte_corpo_select').change();

        function novaFuneraria() {
            let dados = {
                nomeFuneraria: document.querySelector('#nome_funeraria').value,
                cepFuneraria: document.querySelector('#cep_funeraria').value,
                logradouroFuneraria: document.querySelector('#logradouro_funeraria').value,
                numeroFuneraria: document.querySelector('#numero_funeraria').value,
                bairroFuneraria: document.querySelector('#bairro_funeraria').value,
                cidadeFuneraria: document.querySelector('#cidade_funeraria').value,
                estadoFuneraria: document.querySelector('#estado_funeraria').value
            }
            if (!!dados.nomeFuneraria && !!dados.cepFuneraria && !!dados.logradouroFuneraria && !!dados.numeroFuneraria && !
                !dados.bairroFuneraria && !!dados.cidadeFuneraria && !!dados.estadoFuneraria) {
                let url = '{{ URL::to('/api/createfuneraria') }}';
                $('#loadingNovaFuneraria').show();
                axios.post(url, dados)
                    .then(function(response) {
                        if (response.data.code == 0) {
                            flasher.success(response.data.message);
                            axios.get('{{ route('funerarias.getFunerariasAPI') }}')
                                .then(function(funerarias) {
                                    // handle success
                                    $('#funeraria-select').html("");
                                    $('#funeraria-select').append(
                                        `<option value="" disabled>Selecione a funerária</option>`);
                                    $.each(funerarias.data, function(index, value) {
                                        if (response.data.id == value.id) {
                                            $('#funeraria-select').append(`
                                    <option value="${value.id}" selected>${value.nome}</option>
                                    `);
                                        } else {
                                            $('#funeraria-select').append(`
                                    <option value="${value.id}">${value.nome}</option>
                                    `);
                                        }

                                    });
                                    $('#nova-funeraria').modal('hide');
                                    $('input[id*="funeraria"]').val("");
                                    $('#loadingNovaFuneraria').hide();
                                })
                                .catch(function(error) {
                                    $('#loadingNovaFuneraria').hide();
                                });

                        } else {
                            toast.error(response.data.message);
                            $('#loadingNovaFuneraria').hide();
                        }
                    })
                    .catch(function(error) {
                        console.error(error);
                        $('#loadingNovaFuneraria').hide();
                    });
            } else {
                toast.error("É necessário preencher todos os campos.");
            }
        }
    </script>
    
    <script>
        $(document).ready(function() {
            $('#justificativa').summernote({
                height: 200, // altura do editor
                lang: 'pt-BR',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol']],
                    ['insert', []] // Remove upload de imagem e vídeo
                ]
            });
        });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script> 
        var status = {{ $corpo->status }};
        if (status == '6') {            
            document.addEventListener("DOMContentLoaded", function() {
            let form = document.getElementById("meuFormulario");
            let confirmModal = new bootstrap.Modal(document.getElementById("justificativaModal"));
            let confirmButton = document.getElementById("confirmarEnvio");
            let modified = false;

            // Detectar mudanças nos campos do formulário
            form.querySelectorAll("input, textarea, select").forEach((field) => {
                field.addEventListener("input", () => {
                    modified = true;
                    console.log("Formulário modificado!");
                });
            });

            // Interceptar o envio do formulário
            form.addEventListener("submit", function(event) {
                // Validação HTML5 padrão
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    toast.error("Preencha todos os campos obrigatórios!");
                    $('html, body').animate({
                        scrollTop: 0
                    }, 200);
                    return;
                }
                
                // Se foi modificado, mostrar modal de confirmação
                if (modified) {
                    event.preventDefault();
                    confirmModal.show();
                }
            });

            // Se o usuário confirmar, prosseguir com o envio
            confirmButton.addEventListener("click", function() {
                modified = false; // Reseta o estado
                form.submit();
            });

            // Aviso ao sair da página sem salvar
            window.addEventListener("beforeunload", function(event) {
                if (modified) {
                    event.preventDefault();
                    event.returnValue = "Você tem alterações não salvas!";
                }
            });
        });
        }

    </script>
@endsection