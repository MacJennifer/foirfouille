@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="category">
                    @if (
                        $productsByCategories->flatten()->contains(function ($product) {
                            return $product->promotions->isNotEmpty();
                        }))
                        <form class="form-inline" action="{{ route('product.search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control search-input" name="query"
                                    placeholder="Rechercher un produit" aria-label="Rechercher un produit"
                                    aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-addon2">Rechercher</button>
                                </div>
                            </div>
                        </form>
                        <h2>Produits en promotion</h2>
                        <div class="row">
                            @foreach ($productsByCategories as $products)
                                @foreach ($products as $product)
                                    @if ($product->promotions->isNotEmpty())
                                        <div class="col-md-6 mb-3 mt-5">
                                            <div class="card">
                                                <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                                    class="card-img-top-home" alt="{{ $product->name }}">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $product->name }}</h5>
                                                    <p class="card-text">
                                                        {{ \Illuminate\Support\Str::limit($product->description, 50, $end = '...') }}
                                                    </p>
                                                    <p class="card-text"><strong>Prix : {{ $product->price }} €</strong></p>


                                                    @foreach ($product->promotions as $promotion)
                                                        <p class="card-text">
                                                            <span
                                                                style="background-color: yellow; color: red; padding: 2px 5px; border-radius: 3px;">
                                                                Prix en promotion:
                                                                <strong>{{ $promotion->pivot->promotionPrice }} €</strong>
                                                            </span>
                                                            <br>
                                                            <span>
                                                                Réduction : <strong>{{ $promotion->reduction }} %</strong>
                                                            </span>
                                                        </p>
                                                    @endforeach

                                                    <a href="{{ route('product.show', $product->id) }}"
                                                        class="btn btn-primary">Voir
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
                @foreach ($productsByCategories as $categorieName => $products)
                    <div class="category">
                        <h2 class="mt-5">{{ $categorieName }}</h2>
                        <div class="row">
                            @foreach ($products as $product)
                                @if ($product->promotions->isEmpty())
                                    <div class="col-md-6 mb-3 mt-5">
                                        <div class="card">
                                            <img src="{{ asset('storage/uploads/' . $product->image) }}"
                                                class="card-img-top" alt="{{ $product->name }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">
                                                    {{ \Illuminate\Support\Str::limit($product->description, 50, $end = '...') }}
                                                </p>
                                                <p class="card-text">Prix: {{ $product->price }} €</p>

                                                <a href="{{ route('product.show', $product->id) }}"
                                                    class="btn btn-primary">Voir
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
    <footer>
        <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="image logo"></a>
    </footer>
@endsection
