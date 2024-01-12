@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Foir'Fouille</h1>

                {{-- Afficher les produits en promotion --}}
                <div class="category">
                    <h2>Produits en Promotion</h2>
                    <div class="row">
                        @foreach ($productsByCategories as $products)
                            @foreach ($products as $product)
                                @if ($product->promotions->isNotEmpty())
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="{{ asset('storage/uploads/' . $product->image) }}" class="card-img-top"
                                                alt="{{ $product->name }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">
                                                    {{ \Illuminate\Support\Str::limit($product->description, 50, $end = '...') }}
                                                </p>
                                                <p class="card-text">Prix: {{ $product->price }} €</p>

                                                @foreach ($product->promotions as $promotion)
                                                    <p class="card-text">
                                                        <span style="background-color: yellow; color: red; padding: 2px 5px; border-radius: 3px;">
                                                            Prix en promotion: {{ $promotion->pivot->promotionPrice }} €
                                                        </span>
                                                        <br>
                                                        <span>
                                                            Réduction: {{ $promotion->reduction }} %
                                                        </span>
                                                    </p>
                                                @endforeach

                                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Voir
                                                    plus</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>

                {{-- Boucle pour les catégories --}}
                @foreach ($productsByCategories as $categorieName => $products)
                    <div class="category">
                        <h2>{{ $categorieName }}</h2>
                        <div class="row">
                            @foreach ($products as $product)
                                @if ($product->promotions->isEmpty())
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <img src="{{ asset('storage/uploads/' . $product->image) }}" class="card-img-top"
                                                alt="{{ $product->name }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">
                                                    {{ \Illuminate\Support\Str::limit($product->description, 50, $end = '...') }}
                                                </p>
                                                <p class="card-text">Prix: {{ $product->price }} €</p>

                                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Voir
                                                    plus</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
