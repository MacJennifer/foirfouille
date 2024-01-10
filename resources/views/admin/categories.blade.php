<!-- categories.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Gestion des catégories</h1>

        <div class="mb-4">
            <a href="{{ route('admin.categories') }}" class="btn btn-success">Nouvelle catégorie</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->id }}</td>
                        <td>{{ $categorie->name }}</td>
                        <td>
                            <a href="{{ route('admin.editCategorie', $categorie->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('admin.destroyCategorie', $categorie->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
