<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public function buscarEnderecoPorCep(string $cep): array|null
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response['erro'])) {
            return null;
        }

        return [
            'logradouro' => $response['logradouro'],
            'bairro' => $response['bairro'],
            'cidade' => $response['localidade'],
            'estado' => $response['uf'],
        ];
    }
}
