@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer une nouvelle catégorie</h1>

        <form action="{{ route('admin.storeCategorie') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom de la catégorie</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer la catégorie</button>
        </form>

        @if(isset($categories) && count($categories) > 0)
            <h2>Liste des catégories</h2>
            @foreach($categories as $categorie)
                <div>
                    {{ $categorie->name }}
                    <a href="{{ route('admin.editCategorie', $categorie->id) }}" class="btn btn-warning">Modifier</a>
                    <form action="{{ route('admin.destroyCategorie', $categorie->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            @endforeach
        @else

        @endif
    </div>
@endsection
