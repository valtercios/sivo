<?php

use Carbon\Carbon;

function calcularIdade($data_nascimento, $data_atual)
{
    $years = Carbon::parse($data_nascimento)->diffInYears($data_atual);
    $months = Carbon::parse($data_nascimento)->diffInMonths($data_atual);
    $days = Carbon::parse($data_nascimento)->diffInDays($data_atual);
    if ($years > 0) {
        $yearsInMonths = 12 * $years;
        $remainingMonths = $months - $yearsInMonths;
        if($remainingMonths > 0){
            $years = $years == 1 ? '1 ano' : $years . ' anos';
            $remainingMonths = $remainingMonths == 1 ? '1 mês' : $remainingMonths . ' meses';
            $text = $years . ' e ' . $remainingMonths;
        }else{
           $text = $years == 1 ? '1 ano' : $years . ' anos'; 
        }
        $dados = (object) [
            "text" => $text,
            "type" => "ano",
            "value" => $years
        ];
        return $dados;
    }
    if ($months > 0) {
        $dados = (object) [
            "text" => $months == 1 ? '1 mês' : $months . ' meses',
            "type" => "mes",
            "value" => $months
        ];
        return $dados;
    }
    if ($days > 0) {
        $dados = (object) [
            "text" => $days == 1 ? '1 dia' : $days . ' dias',
            "type" => "dia",
            "value" => $days
        ];
        return $dados;
    }

    $dados = (object) [
        "text" => "",
        "type" => "invalid",
        "value" => 0
    ];
    return $dados;
}

function tirarAcentos($string)
{
    return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/"), explode(" ", "a A e E i I o O u U n N c"), $string);
}

function buscarEstado($busca)
{
    $estadosBrasil = array(
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espirito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MS' => 'Mato Grosso do Sul',
        'MT' => 'Mato Grosso',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    );
    return $estadosBrasil[$busca] ?? 'Não encontrado';
}

function getEstados()
{
    return array(
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espirito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MS' => 'Mato Grosso do Sul',
        'MT' => 'Mato Grosso',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    );
}

function baseImage64($path)
{
    // $pathLogo = asset($path);
    // $typeLogo = pathinfo($pathLogo, PATHINFO_EXTENSION);
    // $dataLogo = file_get_contents($pathLogo);
    // $logoBase64 = 'data:image/' . $typeLogo . ';base64,' . base64_encode($dataLogo);

    // return $logoBase64;
}


function sortLink($label, $column) {
    $currentSort = request('sort');
    $direction = request('direction') === 'asc' ? 'desc' : 'asc';
    $icon = '';

    if ($currentSort === $column) {
        $icon = request('direction') === 'asc' ? '↑' : '↓';
    }

    $query = array_merge(request()->query(), [
        'sort' => $column,
        'direction' => $direction
    ]);

    return '<a href="'.request()->url().'?'.http_build_query($query).'">'.$label.' '.$icon.'</a>';
}
