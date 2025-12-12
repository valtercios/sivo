@extends('layout.app')

@section('title')
    <h3>Exames</h3>
    <p class="text-subtitle text-muted">Gerenciamento de exames do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('exames.index') }}">Exames</a></li>
        <li class="breadcrumb-item active" aria-current="page">Responder exame
        </li>
    </ol>
@endsection

@section('conteudo')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Responder exame</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('exames.respostastore') }}" method="POST">
                @method('post')
                @csrf
                <input type="hidden" name="exame_id" value="{{ $exame->id }}">

                <div class="col-md-12 col-12">
                    <div class="form-group has-icon-left ">
                        <label for="data_resposta">Data da resposta</label>
                        <div class="position-relative">
                            <input type="text" id="data_resposta" class="form-control" value="{{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}" disabled name="data_resposta">
                            <div class="form-control-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-12">
                    <div class="form-group has-icon-left ">
                        <label for="corpo">Exame referente ao corpo de</label>
                        <div class="position-relative">
                            <input type="text" id="corpo" class="form-control" value="{{ $exame->corpo->nome }}" disabled name="corpo">
                            <div class="form-control-icon">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class=" col-12">
                    <div class="form-group mb-3">
                        <label for="resposta_exame" class="form-label">Resposta do exame</label>
                        <textarea class="form-control" id="resposta_exame" name="resposta_exame" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="document">Anexos</label>
                    <div class="needsclick dropzone" id="document-dropzone">
        
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('exames.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Responder</button>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
{{-- ...Some more scripts... --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{ route("exames.documentosupload") }}',
        maxFilesize: 2, // MB
        acceptedFiles:'image/jpeg,image/png,image/gif,image/jpg,application/pdf',
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function() {
            @if (isset($project) && $project->document)
                var files =
                    {!! json_encode($project->document) !!}
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
            @endif
        }
    }
    Dropzone.prototype.defaultOptions.dictRemoveFile = "Remover arquivo";
    Dropzone.prototype.defaultOptions.dictDefaultMessage = "Clique ou arraste os arquivos aqui para enviá-los.";
    Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancelar envio";
</script>

@endsection

