@extends('layouts.app')

@section('title', 'Adicionar Livro')

@section('content')
<div class="flex flex-col space-y-4">
    {{-- Botão alinhado à direita --}}
    <form action="{{ route('livros.store') }}" method="post">
        <div class="flex justify-end">
            <a href="{{ route('livros.index') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Voltar
            </a>
            <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-full">
                Salvar Livro
            </button>
        </div>

        <div class="max-w-10xl mx-auto p-6 rounded shadow-md space-y-4">
            <div class="flex gap-4">
                {{-- Campo Nome do Livro --}}
                <div class="flex-1">
                    <label for="no_nome" class="block text-sm font-medium text-gray-700 mb-1">Nome do Livro</label>
                    <input type="text" name="no_nome" id="no_nome"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Digite o nome do livro"
                        value="{{ old('no_nome') }}">
                    @error('no_nome')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Nome do Autor --}}
                <div class="flex-1">
                    <label for="no_autor" class="block text-sm font-medium text-gray-700 mb-1">Autor</label>
                    <input type="text" name="no_autor" id="no_autor"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Digite o nome do autor"
                        value="{{ old('no_autor') }}">
                    @error('no_autor')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Quantidade --}}
                <div class="flex-1">
                    <label for="nu_quantidade" class="block text-sm font-medium text-gray-700 mb-1">Quantidade</label>
                    <input type="text" name="nu_quantidade" id="nu_quantidade"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Digite o nome do autor"
                        value="{{ old('nu_quantidade') }}">
                    @error('nu_quantidade')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-4">
                {{-- Campo Preco --}}
                <div class="flex-1">
                    <label for="nu_preco" class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
                    <input type="text" name="nu_preco" id="nu_preco"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Digite o nome do autor"
                        value="{{ old('nu_preco') }}">
                    @error('nu_preco')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo Data lançamento --}}
                <div class="flex-1">
                    <label for="dt_lancamento" class="block text-sm font-medium text-gray-700 mb-1">Data Lançamento</label>
                    <input type="date" name="dt_lancamento" id="dt_lancamento"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Digite o nome do autor"
                        value="{{ old('dt_lancamento') }}">
                    @error('dt_lancamento')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>


    </form>
</div>
@endsection
