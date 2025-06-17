<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

use App\Services\ViaCepService;
use Illuminate\Http\Request;

Route::get('/buscar-endereco/{cep}', function ($cep, ViaCepService $viaCep) {
    $endereco = $viaCep->buscarEnderecoPorCep($cep);

    if (!$endereco) {
        return response()->json(['erro' => 'CEP não encontrado'], 404);
    }

    return response()->json($endereco);
});
