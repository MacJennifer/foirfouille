@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="category">
                    @if ($productsByCategories->flatten()->contains(function ($product) {
                        return $product->promotions->isNotEmpty();
                    }))
                    <h2>Produits en promotion</h2>
                    <div class="row">
                        @foreach ($productsByCategories as $products)
                            @foreach ($products as $product)
                                @if ($product->promotions->isNotEmpty())
                                    <div class="col-md-6 mb-3 mt-5">
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
                    @else
                        <h2>Pas de promotion actuellement</h2>
                    @endif
                </div>

                {{-- Boucle pour les catégories --}}
                @foreach ($productsByCategories as $categorieName => $products)
                    <div class="category">
                        <h2 class="mt-5">{{ $categorieName }}</h2>
                        <div class="row">
                            @foreach ($products as $product)
                                @if ($product->promotions->isEmpty())
                                    <div class="col-md-6 mb-3 mt-5">
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
