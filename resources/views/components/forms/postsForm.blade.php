<div class="form-group col-md-12">
    <x-adminlte-input name="titulo" label="Titulo" placeholder="Título" enable-old-support value="{{$info->titulo ?? $info->titulo ?? ''}}">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-nfc text-olive"></i>
            </div>
        </x-slot>
    </x-adminlte-input>
  </div>
  <div class="form-group col-md-12">
    @php
        $config = [
            "placeholder" => "Selecione os setores",
           /*  "allowClear" => true, */
        ];
    @endphp
    <x-adminlte-select2 id="sel2Category" name="setores[]" label="Setores"
        label-class="" igroup-size="sm" :config="$config" multiple enable-old-support  value="{{$info->setores ?? $info->setores ?? ''}}">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-tag"></i>
            </div>
        </x-slot>
       {{--  <x-slot name="appendSlot">
            <x-adminlte-button theme="outline-dark" label="Clear" icon="fas fa-lg fa-ban text-danger"/>
        </x-slot> --}}
        @foreach ( $setores as $setor )
          <option value="{{$setor->id}}">{{$setor->sub_nome_novo ?? $setor->sub_nome_antigo}}</option>
        @endforeach --}}
    </x-adminlte-select2>
      {{-- <option value=""></option>
        @foreach ( $setores as $setor )
          <option value="{{$setor->id}}">{{$setor->sub_nome_novo ?? $setor->sub_nome_antigo}}</option>
        @endforeach --}}
    
  </div>

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
<x-adminlte-text-editor name="descricao" label="Descrição" enable-old-support
    igroup-size="sm" placeholder="Descreva a noticia aqui..." :config="$config"> {{$info->post ?? ""}} </x-adminlte-text-editor>