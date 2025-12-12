{{-- Setup data for datatables --}}
@php
$heads = [
    'Sig. Antiga',
    'Sig. Nova',
    'Nome Novo',
    'Nome Nova',
    'Andar',
    ['label' => 'Telefone', 'width' => 40],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';

$config = [
    'data' => [
        foreach ($nomeclaturasSei as $nomeclaturas) {
         echo "[$nomeclaturas->sigla_nova, $nomeclaturas->sigla_antiga, $nomeclaturas->nome_novo, $nomeclaturas->nome_antigo, $nomeclaturas->andar, $nomeclaturas->telefone_sei'<nobr>'.$btnEdit.$btnDelete.'</nobr>'],"
        }
    ],
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="table1" :heads="$heads">
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>