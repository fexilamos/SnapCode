@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl text-white font-bold mb-6">Gestão de Material</h2>

    <!-- Linha com 3 cards lado a lado -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Registar -->
        <div class="bg-gray-100 rounded-xl shadow p-4 text-center">
                       <img src="{{ asset('images/registar.jpg') }}" class="w-full h-36 object-cover rounded mb-4" alt="...">


            <a href="{{ route('materiais.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Registar Material</a>
        </div>

        <!-- Avarias -->
        <div class="bg-gray-100 rounded-xl shadow p-4 text-center">
            <img src="{{ asset('images/avarias.jpg') }}" class="w-full h-36 object-cover rounded mb-4" alt="...">


            <a href="{{ route('avarias.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Avarias</a>
        </div>

        <!-- Perdas -->
        <div class="bg-gray-100 rounded-xl shadow p-4 text-center">
                        <img src="{{ asset('images/perdas.jpg') }}" class="w-full h-36 object-cover rounded mb-4" alt="...">


            <a href="{{ route('perdas.index') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Perdas</a>
        </div>
    </div>

    <!-- Card grande por baixo -->
    <div class="bg-gray-100 rounded-xl shadow p-6 text-center">
                    <img src="{{ asset('images/pesquisa.webp') }}" class="w-full h-36 object-cover rounded mb-4" alt="...">


        <a href="{{ route('materiais.index') }}" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Consultar Materiais</a>
    </div>
</div>
@endsection
