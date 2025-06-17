@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Usuário</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Nome</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" placeholder="Digite seu nome">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2" placeholder="Digite seu email">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">CEP</label>
            <input type="text" name="cep" value="{{ old('cep') }}"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                   placeholder="00000000 (Sem traços)">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Cidade</label>
            <input type="text" name="cidade" id="cidade"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                   readonly placeholder="Cidade">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700">Bairro</label>
            <input type="text" name="bairro" id="bairro"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                   readonly placeholder="Bairro">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700">Estado</label>
            <input type="text" name="estado" id="estado"
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                   readonly placeholder="Estado">
        </div>

        <!-- loading -->
        <div id="loading" style="display:none; color: blue; font-weight: bold; margin-bottom: 1rem;">
            Carregando dados...
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md shadow">
                Cadastrar
            </button>
        </div>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cepInput = document.querySelector('input[name="cep"]');
        const loadingEl = document.getElementById('loading');
        const cidadeInput = document.getElementById('cidade');
        const bairroInput = document.getElementById('bairro');
        const estadoInput = document.getElementById('estado');

        if (!cepInput) return;

        cepInput.addEventListener('blur', async function () {
            const cep = this.value.replace(/\D/g, '');
            if (cep.length !== 8) return;

            cepInput.disabled = true;
            loadingEl.style.display = 'block';

            try {
                const response = await fetch(`/buscar-endereco/${cep}`);

                if (!response.ok) {
                    throw new Error('CEP não encontrado');
                }

                const data = await response.json();

                // Preenche e mantém readonly
                cidadeInput.value = data.cidade;
                bairroInput.value = data.bairro;
                estadoInput.value = data.estado;

            } catch (error) {
                alert(error.message);

                cidadeInput.value = '';
                bairroInput.value = '';
                estadoInput.value = '';
            } finally {
                cepInput.disabled = false;
                loadingEl.style.display = 'none';
            }
        });
    });
</script>