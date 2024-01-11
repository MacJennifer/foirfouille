<!-- resources/views/admin/create_promotion.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer une nouvelle promotion</h1>

        <form action="{{ route('admin.storePromotion') }}" method="POST" id="promotionForm">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nom de la promotion</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="reduction" class="form-label">Réduction en pourcentage</label>
                <input type="number" class="form-control" id="reduction" name="reduction" required>
            </div>

            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de début</label>
                <input type="date" class="form-control" id="date_debut" name="date_debut" required>
            </div>

            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de fin</label>
                <input type="date" class="form-control" id="date_fin" name="date_fin" required>
            </div>

            <div class="mb-3">
                <label for="products" class="form-label">Sélectionnez les produits</label>
                <select multiple class="form-select" id="products" name="products[]" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer la promotion</button>
        </form>
    </div>
@endsection
