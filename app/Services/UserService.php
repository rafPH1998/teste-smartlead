<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected ViaCepService $viaCep;

    public function __construct(ViaCepService $viaCep)
    {
        $this->viaCep = $viaCep;
    }

    public function getAllUsers()
    {
        return User::with('address')->paginate(5);
    }

    public function createUserWithAddress(array $data): ?User
    {
        $endereco = $this->viaCep->buscarEnderecoPorCep($data['cep']);

        if (!$endereco) {
            return null; 
        }

        return DB::transaction(function () use ($data, $endereco) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            $user->address()->create([
                'cep' => $data['cep'],
                ...$endereco
            ]);

            return $user;
        });
    }
}
