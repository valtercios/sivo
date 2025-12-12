@extends('adminlte::page')

@section('title', 'UGTSIC - Usuario')


@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Usuário - {{$user->name}}</h3>
      </div>
      <div class="card-body" style="margin-left:15%; margin-right:15%;">
        {{-- Noticia detalhes--}}
        <section class="single-post-wrapper">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <h2 class="post-title lg">{{$user->nome}} </h2>
                          <div class="post-content-area">
                              @foreach($array_regras as $regras)
                                    Perfils: {{$regras}}<br>
                                    Permissões: 
                                    @foreach ($array_permissoes as $permissoes)
                                      {{$permissoes. ','}}
                                    @endforeach 
                                    <hr>
                              
                              @endforeach
                        
                          </div><!-- post content area-->
                      
                   
                  </div><!-- col end -->
                  <!-- col end-->
              </div><!-- row end-->
          </div><!-- container-->
      </section><!-- single post end-->
      </div>
      <div class="blog-post">
        <hr>
        <a class="btn btn-danger btn-sm mb-3 mt-2" href="{{route('usuarios.index')}}" role="button">
          <i class="fas fa-angle-double-left"></i> Voltar
        </a>
      </div><!-- /.blog-post -->
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
        "order": [[ 0, 'desc' ]], 
        "pageLength":10,
        "lengthMenu":[[10,30,50,-1], [10,30,50,"Todos"]],
    });
</script>

@stop



