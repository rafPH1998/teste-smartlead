@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Usuários Cadastrados</h1>

    <a href="{{ route('users.create') }}"
       class="inline-block mb-6 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
        + Novo Usuário
    </a>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-300 text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">Nome</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">CEP</th>
                    <th class="px-4 py-2 border">Endereço</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ $user->address->cep ?? '-' }}</td>
                        <td class="px-4 py-2 border">
                            {{ $user->address->logradouro ?? '' }},
                            {{ $user->address->bairro ?? '' }} -
                            {{ $user->address->cidade ?? '' }}/{{ $user->address->estado ?? '' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Nenhum usuário cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
