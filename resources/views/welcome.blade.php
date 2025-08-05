@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vitrine de Produtos</h1>
    <div class="row">
        @foreach ($produtos as $produto)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ $produto->imagem_url }}" class="card-img-top">
                <div class="card-body">
                    <h5>{{ $produto->nome }}</h5>
                    <p>{{ Str::limit($produto->descricao, 100) }}</p>
                    <a href="{{ route('produto.go', $produto->slug) }}" class="btn btn-primary">Ver Produto</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
