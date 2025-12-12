{{-- Minimal --}}
@php
$config = [
    "height" => "500",
    "toolbar" => [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture']],
        ['view', ['fullscreen', 'codeview']],
    ],
   
]
@endphp
<x-adminlte-text-editor name="descricao" label="Descrição"
    igroup-size="sm" placeholder="Descreva a noticia aqui..." :config="$config"/>
