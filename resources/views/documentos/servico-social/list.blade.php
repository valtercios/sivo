@extends('layout.app')

@section('title')
    <h3>Documentos do Serviço Social</h3>
    <p class="text-subtitle text-muted">Documentos referente ao Serviço Social</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Documentos
        </li>
    </ol>
@endsection

@section('conteudo')
    {{-- Filtro de Pesquisa --}}
    <div class="row my-2">
        <div class="col-12 float-end" style="display:inline-block;">
            <div class="form-group has-icon-left">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Pesquise um documento..." id="search-filter">
                    <div class="form-control-icon">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Fim filtro de pesquisa --}}
    <h5>Documentos referente ao falecido {{ $corpo->nome }}</h5>
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('documentos_servico_social.index') }}" class="btn btn-outline-primary btn-md"><i class="bi bi-arrow-repeat"></i> Selecionar outro corpo</a>
    </div>
    <div id="conteudo">

        {{-- Card de documento inicio --}}
        <div class="documento-item">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-auto d-flex justify-content-start ">
                                    <div class="stats-icon bg-primary mb-2">
                                        <i class="bi-file-earmark-fill"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-muted font-semibold">Laudo</h6>
                                    <h6 class="font-extrabold mb-0">Documento que contém as informações referentes ao laudo
                                        do corpo.</h6>
                                </div>
                                
                                <div class="col-auto float-end" style="position:absolute; right: 0; margin-top: 10px;">
                                    
                                    <button onclick="exibirModalUpload('servico_social', 1, {{ $corpo->id }})" class="btn btn-primary"><i
                                            class="bi bi-upload"></i> Upload de documento</button>
                                    <a href="{{ route('documentos_servico_social.gerarLaudo', $corpo->id) }}" target="_blank" class="btn btn-primary "><i class="bi bi-download"></i> Gerar
                                        documento</a>
                                </div>
                                @if(App\Models\Documento::where('papel_documento', 'servico_social')->where('tipo_documento', 1)->where('corpo_id', $corpo->id)->count() == 0)
                                    <h5 class="text-danger" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-exclamation-triangle"></i> Não assinado!</h5>
                                @else
                                    <h5 class="text-success" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-check"></i> Documento assinado</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fim card documento --}}

            {{-- Card de documento inicio --}}
            <div class="documento-item">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon bg-primary mb-2">
                                            <i class="bi-file-earmark-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted font-semibold">Termo de consentimento livre e esclarecido</h6>
                                        <h6 class="font-extrabold mb-0">Documento que contém as informações referentes ao
                                            TCLE.
                                        </h6>
                                    </div>
                                    <div class="col-auto float-end" style="position:absolute; right: 0; margin-top: 10px;">
                                        <button onclick="exibirModalUpload('servico_social', 2 , {{ $corpo->id }})" class="btn btn-primary"><i
                                                class="bi bi-upload"></i> Upload de documento</button>
                                        <a href="{{ route('documentos_servico_social.tcleInfoAdicional', $corpo->id) }}"
                                            target="_blank" class="btn btn-primary "><i class="bi bi-download"></i> Gerar
                                            documento</a>
                                    </div>
                                    @if(App\Models\Documento::where('papel_documento', 'servico_social')->where('tipo_documento', 2)->where('corpo_id', $corpo->id)->count() == 0)
                                    <h5 class="text-danger" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-exclamation-triangle"></i> Não assinado!</h5>
                                @else
                                    <h5 class="text-success" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-check"></i> Documento assinado</h5>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fim card documento --}}

            {{-- Card de documento inicio --}}
            <div class="documento-item">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon bg-primary mb-2">
                                            <i class="bi-file-earmark-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted font-semibold">Declaração de Grau de Parentesco</h6>
                                        <h6 class="font-extrabold mb-0">Declaração de grau de parentesco SVO.</h6>
                                    </div>
                                    <div class="col-auto float-end" style="position:absolute; right: 0; margin-top: 10px;">
                                        <button onclick="exibirModalUpload('servico_social', 4 , {{ $corpo->id }})" class="btn btn-primary"><i
                                            class="bi bi-upload"></i> Upload de documento</button>
                                        <a href="{{ route('documentos_servico_social_grau_parentesco.info_adicional', $corpo->id) }}"
                                            target="_blank" class="btn btn-primary "><i class="bi bi-download"></i> Gerar
                                            documento</a>
                                    </div>
                                    @if(App\Models\Documento::where('papel_documento', 'servico_social')->where('tipo_documento', 4)->where('corpo_id', $corpo->id)->count() == 0)
                                    <h5 class="text-danger" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-exclamation-triangle"></i> Não assinado!</h5>
                                @else
                                    <h5 class="text-success" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-check"></i> Documento assinado</h5>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fim card documento --}}

            {{-- Card de documento inicio --}}
            <div class="documento-item">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon bg-primary mb-2">
                                            <i class="bi-file-earmark-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted font-semibold">Termo de consentimento familiar de autopsia
                                            verbal
                                        </h6>
                                        <h6 class="font-extrabold mb-0">Termo de consentimento familia de autopsia verbal
                                            do
                                            SVO.</h6>
                                    </div>
                                    <div class="col-auto float-end"
                                        style="position:absolute; right: 0; margin-top: 10px;">
                                        <button onclick="exibirModalUpload('servico_social', 8 , {{ $corpo->id }})" class="btn btn-primary"><i
                                            class="bi bi-upload"></i> Upload de documento</button>
                                        <a href="{{ route('documentos_servico_social.gerarTermoConsentimentoFamiliarAutopsiaVerbal', $corpo->id) }}" target="_blank" class="btn btn-primary "><i class="bi bi-download"></i> Gerar
                                            documento</a>
                                    </div>
                                    @if(App\Models\Documento::where('papel_documento', 'servico_social')->where('tipo_documento', 8)->where('corpo_id', $corpo->id)->count() == 0)
                                    <h5 class="text-danger" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-exclamation-triangle"></i> Não assinado!</h5>
                                @else
                                    <h5 class="text-success" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-check"></i> Documento assinado</h5>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fim card documento --}}

            {{-- Card de documento inicio --}}
            <div class="documento-item">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon bg-primary mb-2">
                                            <i class="bi-file-earmark-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted font-semibold">Termo de responsabilidade</h6>
                                        <h6 class="font-extrabold mb-0">Termo de responsabilidade do SVO.</h6>
                                    </div>
                                    <div class="col-auto float-end"
                                        style="position:absolute; right: 0; margin-top: 10px;">
                                        <button onclick="exibirModalUpload('servico_social', 9 , {{ $corpo->id }})" class="btn btn-primary"><i
                                            class="bi bi-upload"></i> Upload de documento</button>
                                        <a href="{{ route('documentos_servico_social.gerarTermoResponsabilidade', $corpo->id) }}" target="_blank" class="btn btn-primary "><i class="bi bi-download"></i> Gerar
                                            documento</a>
                                    </div>
                                    @if(App\Models\Documento::where('papel_documento', 'servico_social')->where('tipo_documento', 9)->where('corpo_id', $corpo->id)->count() == 0)
                                    <h5 class="text-danger" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-exclamation-triangle"></i> Não assinado!</h5>
                                @else
                                    <h5 class="text-success" style="text-align: right; margin: 10px 0px -10px 0px"><i class="bi bi-check"></i> Documento assinado</h5>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fim card documento --}}


            {{-- Card de documento inicio --}}
            <div class="documento-item">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon bg-primary mb-2">
                                            <i class="bi-file-earmark-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted font-semibold">Declaração de comparecimento</h6>
                                        <h6 class="font-extrabold mb-0">Declaração de comparecimento ao SVO.</h6>
                                    </div>
                                    <div class="col-auto float-end" style="position:absolute; right: 0; margin-top: 10px;">
                                        <button onclick="exibirModalUpload('servico_social', 3 , {{ $corpo->id }})" class="btn btn-primary"><i
                                            class="bi bi-upload"></i> Upload de documento</button>
                                        <a href="{{ route('documentos_servico_social.gerarDeclaracaoDeComparecimento', $corpo->id) }}"
                                            target="_blank" class="btn btn-primary "><i class="bi bi-download"></i> Gerar
                                            documento</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fim card documento --}}

            

            {{-- Card de documento inicio --}}
            <div class="documento-item">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon bg-primary mb-2">
                                            <i class="bi-file-earmark-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted font-semibold">Declaração de Posse de Corpo</h6>
                                        <h6 class="font-extrabold mb-0">Declaração de posse de corpo SVO.</h6>
                                    </div>
                                    <div class="col-auto float-end"
                                        style="position:absolute; right: 0; margin-top: 10px;">
                                        <button onclick="exibirModalUpload('servico_social', 5 , {{ $corpo->id }})" class="btn btn-primary"><i
                                            class="bi bi-upload"></i> Upload de documento</button>
                                        <a href="{{ route('documentos_servico_social.gerarDeclaracaoPosseCorpo', $corpo->id) }}"
                                            target="_blank" class="btn btn-primary "><i class="bi bi-download"></i> Gerar
                                            documento</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fim card documento --}}

            {{-- Card de documento inicio --}}
            <div class="documento-item">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon bg-primary mb-2">
                                            <i class="bi-file-earmark-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted font-semibold">Encaminhamento</h6>
                                        <h6 class="font-extrabold mb-0">Documento de encaminhamento genérico do SVO.</h6>
                                    </div>
                                    <div class="col-auto float-end"
                                        style="position:absolute; right: 0; margin-top: 10px;">
                                        <button onclick="exibirModalUpload('servico_social', 6 , {{ $corpo->id }})" class="btn btn-primary"><i
                                            class="bi bi-upload"></i> Upload de documento</button>
                                        <a href="{{ route('documentos_servico_social_encaminhamento.info_adicional', $corpo->id) }}"
                                            class="btn btn-primary "><i class="bi bi-download"></i> Gerar
                                            documento</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fim card documento --}}

            {{-- Card de documento inicio --}}
            <div class="documento-item">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon bg-primary mb-2">
                                            <i class="bi-file-earmark-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h6 class="text-muted font-semibold">Encaminhamento a defensoria</h6>
                                        <h6 class="font-extrabold mb-0">Encaminhamento a defensoria.</h6>
                                    </div>
                                    <div class="col-auto float-end"
                                        style="position:absolute; right: 0; margin-top: 10px;">
                                        <button onclick="exibirModalUpload('servico_social', 7 , {{ $corpo->id }})" class="btn btn-primary"><i
                                            class="bi bi-upload"></i> Upload de documento</button>
                                        <a href="{{ route('documentos_servico_social_encaminhamento_defensoria.info_adicional', $corpo->id) }}"
                                            target="_blank" class="btn btn-primary "><i class="bi bi-download"></i> Gerar
                                            documento</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Fim card documento --}}

            

            
        </div>
        @include('utils.modals.modal-upload-documento');
    @endsection

    @section('js')
        <script>
            $("#search-filter").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#conteudo .documento-item").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            let papelDocumento;
            let tipoDocumento;
            let corpoID;
            function listarDocumentos() {
                //axios GET
                let BASE_URL = "{{ url('/') }}";
                axios.get(BASE_URL + '/documentos/listardocumentos/' + papelDocumento + '/' + tipoDocumento + '/' + corpoID, {
                params: {
                    papel: papelDocumento,
                    tipo: tipoDocumento,
                    corpo_id: corpoID
                }
            })
                    .then(function(response) {
                        // handle success
                        $("#listagemdocumentos").html(``);
                        if (response.data.length == 0) {
                            $("#listagemdocumentos").html("<h6>Nenhum documento encontrado</h6>");
                        } else {
                            response.data.forEach(element => {
                                $("#listagemdocumentos").append(`
                    <!-- INICIO BLOCO DO DOCUMENTO -->
                        <div class="col-6 col-lg-3 col-md-6">
                            <div class="card bg-light">
                                <div class="card-body p-3">
                                    <form id="deleteArquivo" action="{{ url('documentos/deletararquivo/') }}/${element.id}" method="GET">
                                        <div class="float-end"><a href="javascript:void();" onclick="deletarArquivo(this)" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir Arquivo"><i class="bi bi-trash-fill" ></i></a></div>
                                    </form>
                                    <div style="clear: both"></div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center bg-light ">
                                            <div class="stats-icon bg-light mb-2">
                                                <img src="{{ asset('assets/images/icons/${element.format}.svg') }}" width="60px" alt="">
                                            </div>
                                        </div>
                                        <div class="col-12" style="text-align: center;">
                                            <h6 class="text-muted font-semibold">${element.name.length > 30 ? element.name.substr(0,30)+"..." : element.name}</h6>
                                            <a class="font-extrabold mb-0" target="_blank" href="{{ asset('storage/${element.path}') }}" style="cursor: pointer;">Baixar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fim do documento -->
                    `);
                            });
                        }

                    })
            }

            function exibirModalUpload(papel, tipo, id_corpo) {
                papelDocumento = papel;
                tipoDocumento = tipo;
                corpoID = id_corpo;
                $("#listagemdocumentos").html(`
                <div class="d-flex justify-content-center mb-3">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                </div>
                `);
                listarDocumentos();
                $('#tipo_documento').val(tipoDocumento);
                $('#papel_documento').val(papelDocumento);
                $('#loadingUploadDocument').hide();
                $('#upload-documento').modal('show');

            }

            $('#upload-form').submit(function() {
                $('#loadingUploadDocument').show();
            })

            function deletarArquivo(e) {
                var form = $(e).closest("form");
                var name = $(e).data("name");

                swal.fire({
                    title: "Excluir?",
                    text: "Tem certeza que deseja excluir esse arquivo?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar',
                }).then(function(value) {
                    if (value.isConfirmed) {
                        form.submit(); // Success! 
                        $('#loadingUploadDocument').hide();
                    } else {

                    }
                });
            }
        </script>
    @endsection
