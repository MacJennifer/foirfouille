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
                <a href="#" class="btn btn-success">Ajouter au panier</a>
            </div>
        </div>
    </div>
@endsection
