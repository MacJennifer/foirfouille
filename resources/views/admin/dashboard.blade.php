<!-- dashboard.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Tableau de bord</h1>

        <div class="mb-4">
            <a href="{{ route('admin.create') }}" class="btn btn-success">Nouveau produit</a>
            <a href="{{ route('admin.createCategorie') }}" class="btn btn-primary">Catégorie</a>
            <a href="{{ route('admin.promotions') }}" class="btn btn-primary">Promotions</a>
        </div>

        <div class="row mt-4">
            @foreach ($categories as $categorie)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h2 class="mb-0">{{ $categorie->name }}</h2>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.editCategorie', $categorie->id) }}"
                                    class="btn btn-sm btn-primary">Modifier</a>
                                <form action="{{ route('admin.destroyCategorie', $categorie->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary">Supprimer</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($productsByCategories[$categorie->name] as $product)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                                class="card-img-top" alt="{{ $product->name }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">Prix: {{ $product->price }} €</p>

                                                @forelse ($product->promotions as $promotion)
                                                    <p class="card-text">
                                                        <span
                                                            style="background-color: yellow; color: red; padding: 2px 5px; border-radius: 3px;">
                                                            Prix en promotion: {{ $promotion->pivot->promotionPrice }} €
                                                        </span>
                                                        <br>
                                                        <span>
                                                            Réduction: {{ $promotion->reduction }} %
                                                        </span>
                                                    </p>
                                                @empty
                                                    {{-- Aucune promotion --}}
                                                @endforelse

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('admin.edit', $product->id) }}"
                                                        class="btnProductModif">Modifier</a>
                                                    <a href="{{ route('admin.destroyProducts', $product->id) }}"
                                                        class="btnProductSup">supprimer</a>
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
