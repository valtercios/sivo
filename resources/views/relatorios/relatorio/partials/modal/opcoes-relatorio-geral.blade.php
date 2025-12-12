@section('css')
    @parent

    <style>
        .paragraph-config {
            text-align: left;
        }

        .divider-text {
            font-size: 17px;
            font-weight: bold;
        }
    </style>
@endsection
<!-- Modal filtro corpos -->
<div class="modal fade text-left" id="opcoes-relatorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Configurações do relatório </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="divider">
                                    <div class="divider-text">Seções do relatório que irão aparecer no
                                        PDF</div>
                                    <p class="paragraph-config">Abaixo uma lista de seções que serão exibidas no
                                        PDF do relatório, você
                                        pode marcar uma opção para ser exibida ou desmarcar para que fique escondida.
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio"
                                        name="obitos_municipio">
                                    <label class="form-check-label" for="">ÓBITOS POR MUNICIPIO</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio"
                                        name="obitos_bairro">
                                    <label class="form-check-label" for="">ÓBITOS POR BAIRRO</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio"
                                        name="obitos_medico_interno_externo">
                                    <label class="form-check-label" for="">ÓBITOS QUE UTILIZARAM MÉDICO
                                        INTERNO/EXTERNO</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio"
                                        name="obitos_encaminhados_itep">
                                    <label class="form-check-label" for="">ÓBITOS ENCAMINHADOS AO
                                        ITEP</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio"
                                        name="obitos_encaminhados_liga">
                                    <label class="form-check-label" for="">ÓBITOS ENCAMINHADOS A
                                        LIGA</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio" name="obitos_parto">
                                    <label class="form-check-label" for="">ÓBITOS EM RELAÇÃO AO
                                        PARTO</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio"
                                        name="obitos_local_ocorrencia">
                                    <label class="form-check-label" for="">ÓBITOS POR LOCAL DE
                                        OCORRÊNCIA</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio" name="obitos_mes">
                                    <label class="form-check-label" for="">ÓBITOS POR MÊS</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio"
                                        name="obitos_faixa_etaria">
                                    <label class="form-check-label" for="">ÓBITOS POR FAIXA ETÁRIA</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio" name="obitos_sexo">
                                    <label class="form-check-label" for="">ÓBITOS POR SEXO</label><br>

                                    <input type="checkbox" checked
                                        class="form-check-input form-check-primary opcao-relatorio"
                                        name="obitos_ocupacao">
                                    <label class="form-check-label" for="">ÓBITOS POR OCUPAÇÃO</label><br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="divider">
                                    <div class="divider-text">Elementos que irão aparecer no relatório</div>
                                    <p class="paragraph-config">Selecione os elementos que irão aparecer no PDF do
                                        relatório, se irão aparecer os gráficos, as tabelas, a introdução das seções ou
                                        todos os elementos.
                                    </p>
                                </div>
                                <input type="checkbox" checked
                                    class="form-check-input form-check-primary opcao-relatorio" name="exibir_graficos">
                                <label class="form-check-label" for="">EXIBIR GRÁFICOS</label><br>

                                <input type="checkbox" checked
                                    class="form-check-input form-check-primary opcao-relatorio" name="exibir_tabelas">
                                <label class="form-check-label" for="">EXIBIR TABELAS</label><br>

                                <input type="checkbox" checked
                                    class="form-check-input form-check-primary opcao-relatorio"
                                    name="exibir_introducao">
                                <label class="form-check-label" for="">EXIBIR TEXTO INTRODUTÓRIO</label><br>
                            </div>
                        </div>



                    </div>
                    <div class="mt-4 p-2">
                        <div class="alert alert-light-info color-info">
                            <i class="bi bi-exclamation-circle"></i> Para visualizar as mudanças do relatório clique no
                            botão de <strong>"Salvar"</strong>
                            e em seguida clique no
                            botão de <strong>"Gerar Relatório"</strong> na página principal.
                        </div>
                    </div>

                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fechar</span>
                </button>
                <button type="button" class="btn btn-primary ml-1" onclick="salvarOpcoes(true)">
                    <i class="bx bx-filter d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Salvar</span>
                </button>
            </div>

        </div>
    </div>
</div>

@section('js')
    @parent

    <script>
        function salvarOpcoes(exibirNotificacao = false) {
            let configuracoesSelecionadas = $('.opcao-relatorio:checked');
            let arrayOpcoes = [];
            configuracoesSelecionadas.each(function() {
                arrayOpcoes.push($(this).attr('name'));
            });
            if (exibirNotificacao) {
                flasher.success("Configurações salvas com sucesso!");
            }
            document.querySelector('#configuracoes-relatorio-input').value = btoa(JSON.stringify(arrayOpcoes));
            $('#opcoes-relatorio').modal('hide');

        }

        $(document).ready(function() {
            salvarOpcoes();
        });
    </script>
@endsection
