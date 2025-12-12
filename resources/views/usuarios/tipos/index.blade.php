@extends('adminlte::page')

@section('title', 'UGTSIC - TIPOS DE USUÁRIOS')

@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tipos de Usuários</h3>
      </div>
    @can('usuarios_create')
      <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{route('usuarios.tipos.store')}}" method="post">
                    @csrf
                    @include('usuarios.tipos.form')
                    <div class="form-group text-center">
                        <button type="submit" name="btn-salvar" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Criar novo Tipo de Usuário</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan
        <table class="table table projects">
            <thead>
                <tr style="text-align:center">
                    <th style="width: 1%;">
                        #
                    </th>
                    <th style="width: 70%">
                       Tipos de Usuários
                    </th>
                    @can('usuarios_edit', 'usuarios_delete')
                    <th style="width: 15%; ">
                        Ações
                    </th>
                    @endcan
                </tr>
            </thead>
            <tbody>
               
                @foreach ( $tipos as $tipo )
                
                <tr style="text-align: center">
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{ $tipo->name}}
                    </td>
                    @can('usuarios_edit', 'usuarios_delete')
                    <td class="project-actions text-right">
                        @can('usuarios_edit')
                        <a data-toggle="modal" data-target="#myModal" data-name="{{$tipo->name}}" data-id="{{$tipo->id}}" onclick="editar(this)" class="btn btn-xs btn-default text-info mx-1 " {{-- href="{{route('estagiarios.edit', ['id'=>$curso->id])}} --}}>
                            <i class="fas fa-pencil-alt">
                            </i> Editar
                           
                        </a>
                        @endcan
                        @can('usuarios_delete')
                        <a  class="btn btn-xs btn-default text-danger mx-1 " title="Excluir" onclick="return confirm('Tem certeza que deseja Excluir a linguagem?')" href="{{route('usuarios.tipos.destroy', ['id'=>$tipo->id])}}" title="Excluir">
                            <i class="fas fa-trash">
                            </i> Excluir
                         
                        </a>
                        @endcan
                    </td>
                    @endcan
                </tr>
               
                @endforeach
            </tbody>
        </table>
         <!-- Modal cursos -->
         <div class="modal fade" id="myModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-12">
                            <form action="{{route('usuarios.tipos.update')}}" method="POST">
                                @method('PUT')
                                @csrf
                                @include('usuarios.tipos.form')
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Salvar" class="btn btn-success float-right">
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->
      </div>
      <div class="card-footer">
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $('.table').DataTable({
        language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
        "order": [[ 0, 'asc' ]], 
        "pageLength":30,
        "lengthMenu":[[10,30,50,-1], [10,30,50,"Todos"]],
    });

 
    $('#myModal').on('show.bs.modal', function (event) {                                                       
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipientId = button.data('id') 
        var recipientName = button.data('name') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        
        modal.find('#id').val(recipientId)
        modal.find('#name').val(recipientName)
    })

</script>

@stop