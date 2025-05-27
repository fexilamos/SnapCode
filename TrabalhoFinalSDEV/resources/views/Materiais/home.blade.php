@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">

    <h2 class="text-white mb-4">Gestão de Material</h2>

    <!-- Linha com 3 cards lado a lado -->
    <div class="row mb-4">
        <!-- Registar -->
        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x150" class="card-img-top" alt="Imagem Registar">
                <div class="card-body text-center">
                    <h5 class="card-title">Registar Material</h5>
                    <a href="{{ route('materiais.create') }}" class="btn btn-primary">Registar</a>
                </div>
            </div>
        </div>

        <!-- Avarias -->
        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x150" class="card-img-top" alt="Imagem Avarias">
                <div class="card-body text-center">
                    <h5 class="card-title">Avarias</h5>
                    <a href="{{ route('avarias.index') }}" class="btn btn-warning">Ver Avarias</a>
                </div>
            </div>
        </div>

        <!-- Perdas -->
        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x150" class="card-img-top" alt="Imagem Perdas">
                <div class="card-body text-center">
                    <h5 class="card-title">Perdas</h5>
                    <a href="{{ route('perdas.index') }}" class="btn btn-danger">Ver Perdas</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card grande para Consultar -->
    <div class="card">
        <img src="{{ asset('images/consultar-material.jpg') }}" class="card-img-top" alt="Imagem Consulta de Materiais">
        <div class="card-body text-center">
            <h4 class="card-title">Consultar Materiais</h4>
            <a href="{{ route('materiais.index') }}" class="btn btn-success">Consultar</a>
        </div>
    </div>

</div>
@endsection
