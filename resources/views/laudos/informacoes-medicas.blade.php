@extends('layout.app')
@section('title')
    <h3>Laudos</h3>
    <p class="text-subtitle text-muted">Gerenciamento de laudos do sistema</p>

@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Laudos
        </li>
    </ol>
@endsection

@section('conteudo')
    <form action="{{ route('laudos.store', $id) }}" method="post" enctype="multipart/form-data" id="form-informacoes-medicas">
        @csrf
        <input type="hidden" name="encaminhar_itep" id="encaminhar_itep" value="0">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Identificação</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            @include('corpos.partials.form.show.card-identificacao')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Digitador'))
            @include('components.select-escrivao')
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Informações médicas</h4>
                <br>
                <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha as
                    informações médicas adicionais.</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="historico" class="form-label">Histórico</label>
                            <textarea class="form-control" id="historico" name="historico" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Exame</h4>
                <br>
                <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha
                    informações referentes ao exame.</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <!--data e hora do exame-->
                    <div class="col-md-5 col-12">
                        <div class="form-group has-icon-left">
                            <label for="data-exame">Data e hora da realização do exame</label><span class="text-danger">
                                *</span>
                            <div class="position-relative">
                                <input type="datetime-local" required class="form-control" name="data_exame" id="data_exame"
                                    max="9999-12-31T23:59" value="{{ old('data_exame') ? old('data_exame') : '' }}">
                                <div class="form-control-icon">
                                    <i class="bi bi-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="exame_geral" class="form-label">Geral</label>
                            <textarea class="form-control" id="exame_geral" name="exame_geral" rows="5"></textarea>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="exame_cabeca" class="form-label">Cabeça</label>
                            <textarea class="form-control" id="exame_cabeca" name="exame_cabeca" rows="5"></textarea>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="exame_torax" class="form-label">Tórax</label>
                            <textarea class="form-control" id="exame_torax" name="exame_torax" rows="5"></textarea>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="exame_abdome" class="form-label">Abdome</label>
                            <textarea class="form-control" id="exame_abdome" name="exame_abdome" rows="5"></textarea>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="exame_genitalia" class="form-label">Genitália</label>
                            <textarea class="form-control" id="exame_genitalia" name="exame_genitalia" rows="5"></textarea>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="exame_membros" class="form-label">Membros</label>
                            <textarea class="form-control" id="exame_membros" name="exame_membros" rows="5"></textarea>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">Macroscopia</label>
                            <textarea class="form-control" id="exame_macroscopia" name="exame_macroscopia" rows="5"></textarea>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="exame_microscopia" class="form-label">Microscopia</label>
                            <textarea class="form-control" id="exame_microscopia" name="exame_microscopia" rows="5"></textarea>
                        </div>
                    </div>
                    <div class=" col-12">
                        <div class="form-group mb-3">
                            <label for="exame_conclusoes" class="form-label">Conclusões diagnósticas</label>
                            <textarea class="form-control" id="exame_conclusoes" name="exame_conclusoes" rows="5"></textarea>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Causas da morte</h4>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#pesquisa-cid10"
                    class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i class="bi bi-search"></i>
                    Pesquisar CID10</a>
                <br>
                <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha as
                    informações sobre as causas da morte.</p>
            </div>
            <div class="card-body" style="padding-left:2rem;">
                <h6>PARTE I - Doença ou estado mórbido que causou diretamente a morte</h6>
                {{-- INICIO CAUSA BLOCO --}}
                <div class="row">
                    a)
                    <div class=" col-6">
                        <div class="form-group mb-3">
                            <label for="causa_a_descricao" class="form-label">Descrição</label>
                            <input type="text" name="causa_a_descricao" class="form-control">
                        </div>
                    </div>
                    <div class=" col-3">
                        <div class="form-group mb-3">
                            <label for="causa_a_tempo" class="form-label">Tempo</label>

                            <div class="input-group">
                                <input type="number" min="0" name="causa_a_tempo" class="form-control"
                                    aria-label="Tempo">
                                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                                <select name="causa_a_tipo_tempo" id="" class="form-control">
                                    <option value="" disabled selected>Tempo</option>
                                    <option value="minutos">Minutos</option>
                                    <option value="horas">Horas</option>
                                    <option value="dias">Dias</option>
                                    <option value="semanas">Semanas</option>
                                    <option value="meses">Meses</option>
                                    <option value="anos">Anos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">CID</label>
                            <input type="text" name="causa_a_cid" class="form-control">
                        </div>
                    </div>
                </div>
                {{-- FIM CAUSA BLOCO --}}

                {{-- INICIO CAUSA BLOCO --}}
                <div class="row">
                    b)
                    <div class=" col-6">
                        <div class="form-group mb-3">
                            <label for="causa_b_descricao" class="form-label">Descrição</label>
                            <input type="text" name="causa_b_descricao" class="form-control">
                        </div>
                    </div>
                    <div class=" col-3">
                        <div class="form-group mb-3">
                            <label for="causa_b_tempo" class="form-label">Tempo</label>

                            <div class="input-group">
                                <input type="number" min="0" name="causa_b_tempo" class="form-control"
                                    aria-label="Tempo">
                                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                                <select name="causa_b_tipo_tempo" id="" class="form-control">
                                    <option value="" disabled selected>Tempo</option>
                                    <option value="minutos">Minutos</option>
                                    <option value="horas">Horas</option>
                                    <option value="dias">Dias</option>
                                    <option value="semanas">Semanas</option>
                                    <option value="meses">Meses</option>
                                    <option value="anos">Anos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">CID</label>
                            <input type="text" name="causa_b_cid" class="form-control">
                        </div>
                    </div>
                </div>
                {{-- FIM CAUSA BLOCO --}}

                {{-- INICIO CAUSA BLOCO --}}
                <div class="row">
                    c)
                    <div class=" col-6">
                        <div class="form-group mb-3">
                            <label for="causa_c_descricao" class="form-label">Descrição</label>
                            <input type="text" name="causa_c_descricao" class="form-control">
                        </div>
                    </div>
                    <div class=" col-3">
                        <div class="form-group mb-3">
                            <label for="causa_c_tempo" class="form-label">Tempo</label>

                            <div class="input-group">
                                <input type="number" min="0" name="causa_c_tempo" class="form-control"
                                    aria-label="Tempo">
                                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                                <select name="causa_c_tipo_tempo" id="" class="form-control">
                                    <option value="" disabled selected>Tempo</option>
                                    <option value="minutos">Minutos</option>
                                    <option value="horas">Horas</option>
                                    <option value="dias">Dias</option>
                                    <option value="semanas">Semanas</option>
                                    <option value="meses">Meses</option>
                                    <option value="anos">Anos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">CID</label>
                            <input type="text" name="causa_c_cid" class="form-control">
                        </div>
                    </div>
                </div>
                {{-- FIM CAUSA BLOCO --}}

                {{-- INICIO CAUSA BLOCO --}}
                <div class="row">
                    d)
                    <div class=" col-6">
                        <div class="form-group mb-3">
                            <label for="causa_d_descricao" class="form-label">Descrição</label>
                            <input type="text" name="causa_d_descricao" class="form-control">
                        </div>
                    </div>
                    <div class=" col-3">
                        <div class="form-group mb-3">
                            <label for="causa_d_tempo" class="form-label">Tempo</label>

                            <div class="input-group">
                                <input type="number" min="0" name="causa_d_tempo" class="form-control"
                                    aria-label="Tempo">
                                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                                <select name="causa_d_tipo_tempo" id="" class="form-control">
                                    <option value="" disabled selected>Tempo</option>
                                    <option value="minutos">Minutos</option>
                                    <option value="horas">Horas</option>
                                    <option value="dias">Dias</option>
                                    <option value="semanas">Semanas</option>
                                    <option value="meses">Meses</option>
                                    <option value="anos">Anos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">CID</label>
                            <input type="text" name="causa_d_cid" class="form-control">
                        </div>
                    </div>
                </div>
                {{-- FIM CAUSA BLOCO --}}
                <h6>PARTE II - Outras condições significativas que contribuiram para a morte e que não entraram, porém, na
                    cadeia acima.</h6>
                <div class="row">
                    1
                    <div class=" col-6">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">Descrição</label>
                            <input type="text" name="causa_extra1_descricao" class="form-control">
                        </div>
                    </div>
                    <div class=" col-3">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">Tempo</label>

                            <div class="input-group">
                                <input type="number" min="0" class="form-control" name="causa_extra1_tempo"
                                    aria-label="Tempo">
                                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                                <select name="causa_extra1_tipo_tempo" id="" class="form-control">
                                    <option value="" disabled selected>Tempo</option>
                                    <option value="minutos">Minutos</option>
                                    <option value="horas">Horas</option>
                                    <option value="dias">Dias</option>
                                    <option value="semanas">Semanas</option>
                                    <option value="meses">Meses</option>
                                    <option value="anos">Anos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-2">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">CID</label>
                            <input type="text" name="causa_extra1_cid" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    2
                    <div class=" col-6">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">Descrição</label>
                            <input type="text" name="causa_extra2_descricao" class="form-control">
                        </div>
                    </div>
                    <div class=" col-3">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">Tempo</label>

                            <div class="input-group">
                                <input type="number" min="0" class="form-control" name="causa_extra2_tempo"
                                    aria-label="Tempo">
                                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                                <select name="causa_extra2_tipo_tempo" id="" class="form-control">
                                    <option value="" disabled selected>Tempo</option>
                                    <option value="minutos">Minutos</option>
                                    <option value="horas">Horas</option>
                                    <option value="dias">Dias</option>
                                    <option value="semanas">Semanas</option>
                                    <option value="meses">Meses</option>
                                    <option value="anos">Anos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" col-2">
                        <div class="form-group mb-3">
                            <label for="exame_macroscopia" class="form-label">CID</label>
                            <input type="text" name="causa_extra2_cid" class="form-control">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="status_corpo" id="status_corpo" value="5">
                <input type="hidden" name="status_laudo" id="status_laudo" value="1">

                <div class="col-12 d-flex justify-content-end mt-5">
                    <button type="button" class="btn btn-secondary me-1 mb-1" id="encaminhar-itep-btn"><i
                            class="bi bi-arrow-up-right-circle"></i> Encaminhar para o ITEP</button>
                    <button type="button" id="salvarsemfinalizar" class="btn btn-primary me-1 mb-1 ">Salvar</button>
                    <button type="button" id="salvarfinalizar" class="btn btn-success me-1 mb-1">Salvar e
                        Finalizar</button>
                </div>
            </div>
        </div>
    </form>
    @include('laudos.partials.modals.modal-pesquisa-cid10')
@endsection

@section('js')
    <script>
        $('#encaminhar-itep-btn').on('click', function() {
            swal.fire({
                title: "Encaminhar ao ITEP",
                text: "Tem certeza que deseja encaminhar o corpo ao ITEP? Não tem como voltar atrás.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, encaminhar!',
                cancelButtonText: 'Cancelar',
            }).then(function(value) {
                if (value.isConfirmed) {
                    let inputEncaminharItep = document.querySelector('#encaminhar_itep');
                    let formElement = document.querySelector('#form-informacoes-medicas');
                    inputEncaminharItep.value = "1";
                    formElement.submit();
                } else {

                }
            });
        });

        $('#salvarfinalizar').on('click', function(e) {
            if (document.querySelector('#data_exame').value == "") {
                swal.fire({
                    title: "Data e hora do exame",
                    text: "Preencha a data e hora do exame antes de finalizar.",
                    icon: "warning",
                    confirmButtonColor: '#3085d6',
                });
            } else {
                swal.fire({
                    title: "Finalizar laudo",
                    text: "Tem certeza que deseja finalizar o laudo? Não tem como voltar atrás.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, finalizar!',
                    cancelButtonText: 'Cancelar',
                }).then(function(value) {
                    if (value.isConfirmed) {
                        let formElement = document.querySelector('#form-informacoes-medicas');
                        var status_laudo = $('#status_laudo');
                        var status_corpo = $('#status_corpo');
                        status_corpo.val(6);
                        status_laudo.val(2);
                        formElement.submit();
                    }
                });
            }
        });

        $('#salvarsemfinalizar').on('click', function(e) {
            swal.fire({
                title: "Salvar laudo sem finalizar",
                text: "Tem certeza que deseja salvar sem finalizar o laudo? .",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim!',
                cancelButtonText: 'Cancelar',
            }).then(function(value) {
                if (value.isConfirmed) {
                    var status_corpo = $('#status_corpo');
                    var status_laudo = $('#status_laudo');
                    let formElement = document.querySelector('#form-informacoes-medicas');
                    status_corpo.val(5);
                    status_laudo.val(1);
                    formElement.submit();
                }
            });
        });
    </script>
@endsection
