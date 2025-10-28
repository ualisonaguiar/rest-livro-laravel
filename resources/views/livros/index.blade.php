@extends('layouts.app')

@section('title', 'Listagem de Livro')

@section('content')
<div class="flex flex-col space-y-4">
    {{-- Botão alinhado à direita --}}
    <div class="flex justify-end">
        <a href="{{ route('livros.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            Adicionar Livro
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data de Lançamento</th>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($livros as $livro)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 whitespace-nowrap text-left text-sm text-gray-700">{{ $livro->no_nome }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-left text-sm text-gray-700">{{ $livro->no_autor }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-right text-sm text-gray-700 text-right">{{ $livro->nu_quantidade }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-left text-sm text-gray-700 text-right">R$ {{ number_format($livro->nu_preco, 2, ',', '.') }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-left text-sm text-gray-700">{{ \Carbon\Carbon::parse($livro->dt_lancamento)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-center">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    <div>
        @include('layouts.partials.pagination', ['registers' => $livros])
    </div>
</div>
@endsection
