<!-- dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Tableau de bord</h1>

        <div class="mb-4">
            <a href="{{ route('admin.create') }}" class="btn btn-success">Nouveau produit</a>
        </div>

        <div class="row mt-4">
            @foreach ($categories as $categorie)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="mb-0">{{ $categorie->name }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($productsByCategories[$categorie->name] as $product)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">Prix: {{ $product->price }} €</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('admin.edit', $product->id) }}" class="btn btn-primary">Modifier</a>
                                                    <form action="{{ route('admin.destroyProducts', $product->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection