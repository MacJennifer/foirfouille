<!-- resources/views/cart/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Panier</h1>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Retour à mes achats</a>
        @if (count($cart) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Image</th>
                        <th>Prix</th>
                        <th>Prix Promotion</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $productId => $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td><img src="{{ asset('storage/uploads/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="img-thumbnail"></td>
                            <td>
                                {{ $product->price }} €
                            </td>
                            <td>
                                @if ($product->promotions->isNotEmpty())
                                    @foreach ($product->promotions as $promotion)
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
                                    @endforeach
                                @else
                                    <p>Aucune promotion </p>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="total">Total à payer : {{ $total }} €</p>
        @else
            <p>Le panier est vide.</p>
        @endif
    </div>
@endsection
