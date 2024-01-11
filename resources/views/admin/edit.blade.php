@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le produit</h1>

        <form action="{{ route('admin.update', $product) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">URL de l'image</label>
                <input type="file" class="form-control" id="image" name="image" value="{{ $product->image }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description du produit</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prix du produit</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
            </div>

            <div class="mb-3">
                <label for="categorie_id" class="form-label">Catégorie du produit</label>
                <select class="form-control" id="categorie_id" name="categorie_id" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $categorie->id == $product->categorie_id ? 'selected' : '' }}>
                            {{ $categorie->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>
    </div>
@endsection
