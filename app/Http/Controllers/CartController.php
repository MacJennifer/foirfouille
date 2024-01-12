<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index()
    {
        // Afficher le contenu du panier
        $cart = session('cart', []);
        $total = $this->total($cart);
        return view('cart.index', compact('cart', 'total'));
    }

    public function total($cart)
    {
        $total = 0;

        foreach ($cart as $productId => $product) {

            if ($product->promotions->isNotEmpty()) {

                $total += $product->promotions->first()->pivot->promotionPrice;
            } else {
                // Utilisez le prix normal
                $total += $product->price;
            }
        }

        return $total;

    }

    public function show()
    {
        $cart = session('cart', []);
        return view('cart.show', compact('cart'));

    }

    public function addProduct($productId)
    {
        // Ajouter un produit au panier
        $product = Product::findOrFail($productId);
        $cart = session('cart', []);
        $cart[$productId] = $product;
        session(['cart' => $cart]);

        return Redirect::route('cart.index')->with('success', 'Produit ajouté au panier avec succès');
    }

    public function removeProduct($productId)
    {
        // Supprimer un produit du panier
        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier');
    }
}
