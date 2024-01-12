@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Résultats de la recherche</h2>

        @if(count($products) > 0)
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-6 mb-3 mt-5">
                        <div class="card">
                            <img src="{{ asset('storage/uploads/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">Prix: {{ $product->price }} €</p>

                                @if ($product->promotions->isNotEmpty())
                                    @foreach ($product->promotions as $promotion)
                                        <p class="card-text">
                                            <span style="background-color: yellow; color: red; padding: 2px 5px; border-radius: 3px;">
                                                Prix en promotion: {{ $promotion->pivot->promotionPrice }} €
                                            </span>
                                            <br>
                                            <span>
                                                Réduction: {{ $promotion->reduction }} %
                                            </span>
                                        </p>
                                    @endforeach
                                @endif

                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Voir plus</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Aucun résultat trouvé.</p>
        @endif
    </div>
@endsection
