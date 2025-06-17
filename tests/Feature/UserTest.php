<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
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
    
}
