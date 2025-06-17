<?php

namespace Tests\Feature;

use App\Services\ViaCepService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_cria_usuario_com_endereco()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'João',
            'email' => 'joao@example.com',
            'cep' => '01001000',
        ]);
    
        $response->assertStatus(302); // redirecionamento após sucesso
        $this->assertDatabaseHas('users', ['email' => 'joao@example.com']);
        $this->assertDatabaseHas('addresses', ['cep' => '01001000']);
    }
    
    public function test_retorna_endereco_valido()
    {
        Http::fake([
            'viacep.com.br/*' => Http::response([
                'logradouro' => 'Praça da Sé',
                'bairro' => 'Sé',
                'localidade' => 'São Paulo',
                'uf' => 'SP',
            ], 200)
        ]);

        $service = new ViaCepService();
        $endereco = $service->buscarEnderecoPorCep('01001000');

        $this->assertEquals('Praça da Sé', $endereco['logradouro']);
        $this->assertEquals('São Paulo', $endereco['cidade']);
        $this->assertEquals('SP', $endereco['estado']);
    }
    
}
