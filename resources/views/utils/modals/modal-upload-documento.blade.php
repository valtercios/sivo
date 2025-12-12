<!-- Modal pesquisar cep pelo endereço -->
<div class="modal fade text-left" id="upload-documento" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
    role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Enviar documento </h4>
            <button type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="{{ route('documentos_recepcao.upload', $corpo->id) }}" id="upload-form" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tipo_documento" id="tipo_documento" value="">
            <input type="hidden" name="papel_documento" id="papel_documento" value="">
            <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
            <div class="modal-body">
                <div class="col-md-12 mb-12">
                    <label for="arquivo">Selecione o arquivo</label>
                    <fieldset>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" required name="arquivo" id="arquivo" aria-describedby="arquivo" aria-label="Enviar" accept=".xls, .pdf, .bmp, .doc, .docx, .gif, .jpg, .pdf, .png, .ppt, .pptx, .txt, .xls, xslsx, .zip">
                            <button class="btn btn-primary" type="submit" id="enviar_arquivo_btn"><span class="spinner-border spinner-border-sm" id="loadingUploadDocument" role="status" aria-hidden="true"></span> Enviar</button>
                        </div>
                    </fieldset>
                    <!-- inicio listagem dos arquivos -->
                    <h5>Documentos</h5>
                    <div class="row" style="overflow:auto; max-height: 400px;" id="listagemdocumentos">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="spinner-border" role="status">
                              <span class="visually-hidden">Carregando...</span>
                            </div>
                          </div>
                       
                    </div>


                    <!-- fim da listagem -->







                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Fechar</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div>