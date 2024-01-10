

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Modifier la catégorie</h1>

        @if (session('categorie-success'))
            <div class="alert alert-success mt-3">
                {{ session('categorie-success') }}
            </div>
        @endif

        <form action="{{ route('admin.updateCategorie', $categorie->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom de la catégorie</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $categorie->name }}">
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
@endsection
