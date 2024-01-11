<!-- resources/views/admin/promotions.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center my-4">
            <h1>Promotions</h1>
            <a href="{{ route('admin.createPromotion') }}" class="btn btn-primary">Nouvelle Promotion</a>
        </div>

        @forelse ($promotions as $promotion)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">{{ $promotion->name }}</h3>
                    <p class="card-text">Réduction : {{ $promotion->reduction }}%</p>
                    <p class="card-text">Du {{ date('d/m', strtotime($promotion->date_debut)) }} au {{ date('d/m/y', strtotime($promotion->date_fin)) }}</p>
                    <!-- Ajoutez d'autres informations de promotion si nécessaire -->

                    <!-- Boutons d'action pour la modification et la suppression -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('admin.editPromotion', $promotion->id) }}" class="btn btn-warning">Modifier</a>

                        <form action="{{ route('admin.destroyPromotion', $promotion->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Aucune promotion disponible pour le moment.</p>
        @endforelse
    </div>
@endsection
