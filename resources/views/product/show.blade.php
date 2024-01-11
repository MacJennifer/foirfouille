@extends('layouts.app')

@section('content')
    <div class="container mt-5">
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
                <a href="#" class="btn btn-success">Ajouter au panier</a>
            </div>
        </div>
    </div>
@endsection
