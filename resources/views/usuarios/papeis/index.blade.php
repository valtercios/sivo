@extends('adminlte::page')

@section('title', 'UGTSIC - PAPÉIS DE USUÁRIOS')

@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Papeis dos Usuários</h3>
      </div>
    
      <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{route('papeis.store')}}" method="post">
                    @csrf
                    @include('usuarios.papeis.form')
                    <div class="form-group text-center">
                        <button type="submit" name="btn-salvar" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Criar novo Papel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="alert alert-info" role="alert">
            Papéis são funções para cada grupo de tarefa do sistema. <br>
            
          </div>

        <table class="table table projects">
            <thead>
                <tr style="text-align:center">
                    <th style="width: 1%;">
                        #
                    </th>
                    <th style="width: 70%">
                       Papéis
                    </th>
                    
                    <th style="width: 15%; ">
                        Ações
                    </th>
                   
                </tr>
            </thead>
            <tbody>
                
                @foreach ( $roles as $role )
                
                <tr style="text-align: center">
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{ $role->name}}
                    </td>
                    @can('sistemas_edit', 'sistemas_delete')
                    <td class="project-actions text-right">
                        @can('sistemas_edit')
                        <a data-toggle="modal" data-target="#myModal" data-name="{{$role->name}}" data-id="{{$role->id}}" onclick="editar(this)" class="btn btn-xs btn-default text-info mx-1 " {{-- href="{{route('estagiarios.edit', ['id'=>$curso->id])}} --}}>
                            <i class="fas fa-pencil-alt">
                            </i> Editar
                           
                        </a>
                        @endcan
                        @can('sistemas_delete')
                        <a  class="btn btn-xs btn-default text-danger mx-1 " title="Excluir" onclick="return confirm('Tem certeza que deseja Excluir a linguagem?')" href="{{route('usuarios.tipos.destroy', ['id'=>$role->id])}}" title="Excluir">
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
        <a href="{{route('papeisPermissoes.index')}}" class="btn btn-secondary">VOLTAR</a>
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
                            <form action="{{route('papeis.update')}}" method="POST">
                                @method('PUT')
                                @csrf
                                @include('usuarios.papeis.form')
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
        "pageLength":10,
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