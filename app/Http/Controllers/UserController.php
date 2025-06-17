<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\ViaCepService;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('address')->paginate(10);
        return view('users.index', compact('users'));

    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request, ViaCepService $viaCep)
    {
        $data = $request->validated();

        $endereco = $viaCep->buscarEnderecoPorCep($data['cep']);

        if (!$endereco) {
            return back()->withErrors(['cep' => 'CEP inválido ou não encontrado'])->withInput();
        }

        $user = User::create($request->only('name', 'email'));

        $user->address()->create([
            'cep' => $data['cep'],
            ...$endereco
        ]);

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::with('address')->findOrFail($id);
        return response()->json($user);
    }
}
