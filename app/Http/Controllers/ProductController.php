<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $fillable = ['name', 'image', 'description', 'price', 'categorie_id'];

    public function index()
    {
        $productPromotion = Product::with('promotions')->get();

        $productsByCategories = Product::with('categorie')->get()->groupBy('categorie.name');
        return view('home', compact('productsByCategories', 'productPromotion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
       //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%$query%")->get();

        return view('product.search', compact('products'));
    }
}
