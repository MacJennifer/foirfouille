<!-- resources/views/admin/editPromotion.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la promotion</h1>

        <form action="{{ route('admin.updatePromotion', $promotion->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom de la promotion</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $promotion->name }}" required>
            </div>

            <div class="mb-3">
                <label for="reduction" class="form-label">Réduction en pourcentage</label>
                <input type="number" class="form-control" id="reduction" name="reduction" value="{{ $promotion->reduction }}" required>
            </div>

            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de début</label>
                <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $promotion->date_debut }}" required>
            </div>

            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de fin</label>
                <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $promotion->date_fin }}" required>
            </div>

            <div class="mb-3">
                <!-- Ajoutez d'autres champs pour les informations de promotion si nécessaire -->
            </div>

            <button type="submit" class="btn btn-primary">Modifier la promotion</button>
        </form>
    </div>
@endsection
