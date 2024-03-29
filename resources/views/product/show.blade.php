@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('products.index') }}" class="btn btn-primary">Retour à mes achats</a>
        <div class="row">
            <div class="col-md-6 align-self-start">
                <img src="{{ asset('storage/uploads/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6 align-self-center">
                <h1>{{ $product->name }}</h1>
                <p class="lead">Description: {{ $product->description }}</p>
                <p class="lead">Prix: {{ $product->price }} €</p>
                @forelse ($product->promotions as $promotion)
                    <p class="card-text">
                        <span style="background-color: yellow; color: red; padding: 2px 5px; border-radius: 3px;">
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
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Ajouter au panier</button>
                </form>
                <a href="{{ route('cart.index') }}" class="btn btn-info">Voir le panier</a>
            </div>
        </div>
    </div>
    <footer>
        <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" alt="image logo"></a>
    </footer>
@endsection
