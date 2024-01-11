<!-- resources/views/cart/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Panier</h1>

        @if (count($cart) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Image</th>
                        <th>Prix</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $productId => $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td><img src="{{ asset('storage/uploads/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail"></td>
                            <td>{{ $product->price }} €</td>
                            <td>
                                <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Le panier est vide.</p>
        @endif
    </div>
@endsection
