<?php

if (!function_exists('maskDocumento')) {
    function maskDocumento($doc) {
        $doc = preg_replace('/\D/', '', $doc);
        if (strlen($doc) === 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $doc);
        } elseif (strlen($doc) === 14) {
            return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $doc);
        }
        return $doc;
    }
}

if (!function_exists('maskMeses')) {
    function maskMeses($quantidade)
    {
        $quantidade = (int) $quantidade;
        return $quantidade === 1 ? '1 Mês' : "{$quantidade} Meses";
    }
}

if (!function_exists('maskData')) {
    function maskData($data) {
        $data = preg_replace('/\D/', '', $data);
        return preg_replace("/(\d{4})(\d{2})(\d{2})/", "$3/$2/$1", $data);
    }
}

if (!function_exists('maskTipo')) {
    function maskTipo($valor) {
        return [
            'I' => 'Internet',
            'S' => 'Serviços',
            'T' => 'Telefonia',
        ][$valor] ?? 'Desconhecido';
    }
}

if (!function_exists('maskCidade')) {
    function maskCidade($id)
    {
        $cidades = [
            3921 => 'Ampére',
            4009 => 'Dois Vizinhos',
            3790 => 'Santa Lúcia',
            4226 => 'Salgado Filho',
            4210 => 'Renascença',
            4196 => 'Prudentópolis',
            4308 => 'Vitorino',
            4185 => 'Ponta Grossa',
            2132 => 'Planalto',
            4177 => 'Pinhal de São Bento',
            3980 => 'Castro',
            3977 => 'Carambeí',
            3976 => 'Capitão Leônidas Marques',
            3975  => 'Capanema',
            4031 => 'Francisco Beltrão',
            4024 => 'Flor da Serra do Sul',
            4167 => 'Pato Branco',
            4208 => 'Realeza',
            3979  => 'Cascavel',
            1801 => 'Pinhão',
            3973 => 'Candói',
            3997 => 'Coronel Vivida',
            4048 => 'Honório Serpa',
            4095 => 'Laranjeiras do Sul',
            4110 => 'Manfrinópolis',
            4111 => 'Mangueirinha',
            4122 => 'Marmeleiro',
            4019 => 'Fazenda Rio Grande',
            3932 => 'Araucária',
            4180 => 'Piraquara',
            4365 => 'Campo Erê',
            4560 => 'São Lourenço do Oeste',
            3464 => 'Guaíra',
            4130 => 'Mercedes',
            2092 => 'Mundo Novo',
        ];
        return $cidades[$id] ?? '';
    }
}
