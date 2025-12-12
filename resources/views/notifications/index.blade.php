@extends('layout.app')

@section('title')
    <h3>Notificações</h3>
    <p class="text-subtitle text-muted">Sistema de notificações</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Notificações
        </li>
</ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css')}}">
    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de notificações</h4>
            <a href="{{ route('notificacoes.markallread') }}" class="btn btn-sm icon btn-primary mx-1"  style="float:right;"><i class="bi bi-check"></i> Marcar todas como lida</a>
        </div>
        <div class="card-body">
            <table class="table table" id="table1">
                <thead>
                    <tr>
                        <th>
                            Data
                        </th>
                        <th>
                            Titulo
                        </th>
                        <th >
                            Status
                        </th>
                        <th >
                            Enviado por
                        </th>
                        <th >
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                            <tr style="font-size:16px; {{ !$notification->read_at ? 'font-weight:bold;' : 'font-weight:normal;' }}">
                                <td>
                                    {{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y H:i:s') }}
                                </td>
                                <td>
                                    {{ $notification->data['title'] }}
                                </td>
                                <td>
                                    {{ $notification->read_at ? 'Lida' : 'Não lida' }}
                                </td>
                                <td>
                                    {{ App\Models\User::find($notification->data['user_from'])->name ?? '-' }}
                                </td>
                                <td>
                                    @if($notification->read_at)
                                        <a href="{{ route('notificacoes.markread', $notification->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Marcar como não lida"  class="btn btn-sm icon btn-secondary mx-1"><i class="bi bi-eye-slash"></i></a>
                                    @else
                                        <a href="{{ route('notificacoes.markread', $notification->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Marcar como lida"  class="btn btn-sm icon btn-secondary mx-1"><i class="bi bi-eye"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- @include('usuarios.permissoes.partials.modal-criar-permissao') --}}
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js')}}"></script>
@endsection







