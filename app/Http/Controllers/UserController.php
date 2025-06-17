<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Services\ViaCepService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    { }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = $this->userService->createUserWithAddress($request->validated());

        if (!$user) {
            return back()->withErrors(['cep' => 'CEP inválido ou não encontrado'])->withInput();
        }

        return redirect()->route('users.index');
    }

    public function show(int $id)
    {
        $user = User::with('address')->findOrFail($id);
        return response()->json($user);
    }

    public function searchUserAddress(string $cep, ViaCepService $viaCep)
    {
        $endereco = $viaCep->buscarEnderecoPorCep($cep);

        if (!$endereco) {
            return response()->json(['erro' => 'CEP não encontrado'], 404);
        }
    
        return response()->json($endereco);
    }
    
}
