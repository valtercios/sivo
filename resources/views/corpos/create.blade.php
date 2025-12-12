@extends('layout.app')

@section('title')
    <h3>Corpos</h3>
    <p class="text-subtitle text-muted">Gerenciamento dos corpos do SVO</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('corpos.index') }}">Corpos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Novo corpo
        </li>
    </ol>
@endsection


@section('conteudo')
    <form action="{{ route('corpos.store') }}" method="POST" id="cadastro-corpo-form" class="needs-validation" novalidate>
        @method('post')
        @csrf

        @include('corpos.formCria')

        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('corpos.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
            <button type="submit" id="cadastrar-corpo-btn" class="btn btn-primary me-1 mb-1 ">Cadastrar</button>

        </div>
    </form>
    @include('utils.modals.modal-pesquisa-cep-endereco')
    @include('corpos.partials.modal.nova-funeraria')
@endsection

@section('js')
    @include('utils.choices')
    <script>
        choicesFunerarias = new Choices(document.querySelector('#funeraria-select'));
        choicesFunerarias.disable();
    </script>
    <script src="{{ asset('js/corpos/cadastro.js') }}"></script>

    <script>
        choiceOrgaoEmissorCorpo = new Choices(document.querySelector('select[name="orgao_emissor_corpo"]'));
        choiceOrgaoEmissorResponsavelCorpo = new Choices(document.querySelector(
            'select[name="orgao_emissor_responsavel"]'));
        choiceEstadoRGResponsavelCorpo = new Choices(document.querySelector('select[name="estado_rg_responsavel_corpo"]'));
        choicesEstadoRGCorpo = new Choices(document.querySelector('select[name="estado_rg"]'));
        //choiceOrgaoEmissorResponsavelEntrega = new Choices(document.querySelector('select[name="orgao_emissor_responsavel_entrega"]'));
        //choiceEstadoRGResponsavelEntrega = new Choices(document.querySelector('select[name="estado_rg_responsavel_entrega"]'));

        $('input:not([type*="date"])').keyup(function() {
            $(this).val($(this).val().toUpperCase());
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
                choiceOrgaoEmissorCorpo.disable();
                choicesEstadoRGCorpo.disable();
            } else {
                $('input[name="rg_corpo"]').attr('disabled', false);
                $('input[name="orgao_emissor_corpo"]').attr('disabled', false);
                choiceOrgaoEmissorCorpo.enable();
                choicesEstadoRGCorpo.enable();
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

        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                            flasher.error("Preencha todos os campos obrigatórios!");

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

                            $('html, body').animate({
                                scrollTop: 0
                            }, 200);
                        } else {
                            $('#cadastrar-corpo-btn').prop('disabled', 'true');
                        }

                        form.classList.add('was-validated');

                        /* Log de campos inválidos no console para auxiliar no debug */
                        const invalidFields = form.querySelectorAll(':invalid');

                        console.log("Campos inválidos:");

                        invalidFields.forEach(field => {
                            console.log({
                                name: field.name,
                                id: field.id,
                                type: field.type,
                                value: field.value,
                                validationMessage: field.validationMessage
                            });
                        });
                        /* Fim do log de debug */


                    }, false)
                })
        })()

        $('#cadastrar-funeraria-btn').on('click', novaFuneraria)

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
                                    choicesFunerarias.clearChoices();
                                    choicesFunerarias.setChoices(function(callback) {
                                        return funerarias.data.map(function(funeraria) {
                                            return {
                                                label: funeraria.nome,
                                                value: funeraria.id
                                            };
                                        });
                                    });
                                    choicesFunerarias.setChoiceByValue(response.data.id);
                                    $('#nova-funeraria').modal('hide');
                                    $('#loadingNovaFuneraria').hide();
                                })
                                .catch(function(error) {
                                    $('#loadingNovaFuneraria').hide();
                                });

                        } else {
                            flasher.error(response.data.message);
                            $('#loadingNovaFuneraria').hide();
                        }
                    })
                    .catch(function(error) {
                        console.error(error);
                        $('#loadingNovaFuneraria').hide();
                    });
            } else {
                flasher.error("É necessário preencher todos os campos.");
            }
        }
    </script>

    @if (old('local_obito'))
        <script>
            $(document).ready(function() {
                $('select[name="local_obito"]').change();
            });
        </script>
    @endif

    @if (old('meio_transporte'))
        <script>
            $(document).ready(function() {
                $('#transporte_corpo_select').change();
            });
        </script>
    @endif

    @if (old('responsavel_entrega_igual') !== null)
        <script>
            $(document).ready(function() {
                verificarResponsavel();
            });
        </script>
    @endif

    @if (old('tipo_documento_responsavel_entrega'))
        <script>
            $(document).ready(function() {
                $('select[name="tipo_documento_responsavel_entrega"]').trigger('change');
            });
        </script>
    @endif

    @if (old('tipo_documento'))
        <script>
            $(document).ready(function() {
                $('select[name="tipo_documento"]').trigger('change');
            });
        </script>
    @endif
@endsection
