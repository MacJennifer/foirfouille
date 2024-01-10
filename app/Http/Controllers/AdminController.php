<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function dashboard()
     {
         return view('admin.dashboard');
     }
    public function index()
    {
        $productsByCategories = Product::with('categorie')->get()->groupBy('categorie.name');
        $categories = Categorie::all();

        return view('admin.dashboard', compact('productsByCategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('admin.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,id',

        ]);

        $filename = "";
        if ($request->hasFile('image')) {
          $filenameWithExt = $request->file('image')->getClientOriginalName();
          $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('image')->getClientOriginalExtension();

          $filename = $filenameWithExt. '_' .time().'.'.$extension;

          $request->file('image')->storeAs('public/uploads', $filename);
        } else {
          $filename = Null;
        }

       Product::create([
                'name' => $request->name,
                'image' => $filename,
                'description' => $request->description,
                'price' => $request->price,
                'categorie_id' => $request->categorie_id

       ]);

        // Redirigez avec un message de succès
        return redirect()->route('admin.dashboard')->with('product-success', 'Produit créé avec succès');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);


        return view('admin.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        // $hero->image = $request->input('image');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        $product->save();



        return redirect()->route('admin.dashboard')->with('product-success', 'produit mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function destroyProducts(string $id)
    {
        $product = Product::find($id);

        // Vérifiez si le héros existe
        if ($product) {
            $product->delete();
            session()->flash('product-success', 'Le produit a été supprimé avec succès');
            return redirect()->route('admin.dashboard');
        }

        // Si ni l'utilisateur ni le héros n'existent, retournez une erreur
        return redirect()->route('admin.dashboard')->with('error', 'Le produit n\'a pas été supprimé');
    }

}
