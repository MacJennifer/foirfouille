<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function categories()
    {
        $categories = Categorie::all();
        return view('admin.categories', compact('categories'));
    }

    public function index()
    {
        $productsByCategories = Product::with('categorie')->get()->groupBy('categorie.name');
        $categories = Categorie::all();

        foreach ($categories as $categorie) {
            if (!isset($productsByCategories[$categorie->name])) {
                $productsByCategories[$categorie->name] = collect(); // Créez une nouvelle collection pour la catégorie
            }
        }

        return view('admin.dashboard', compact('productsByCategories', 'categories'));
    }

/********************  CATEGORIE  **************************************************************/

    public function createCategorie()
    {
        return view('admin.createCategorie');
    }

    public function storeCategorie(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categorie::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.dashboard')->with('categorie-success', 'Catégorie créée avec succès');
    }

    public function editCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.editCategorie', compact('categorie'));
    }

    public function updateCategorie(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categorie::findOrFail($id);
        $category->update([
            'name' => $request->name,

        ]);

        return redirect()->route('admin.dashboard')->with('category-success', 'Catégorie mise à jour avec succès');
    }

    public function destroyCategorie($id)
    {
        $categorie = Categorie::find($id);

        // Vérifiez si le héros existe
        if ($categorie) {
            $categorie->delete();
            session()->flash('categorie-success', 'La catégorie a été suppriméé avec succès');
            return redirect()->route('admin.dashboard');
        }


        return redirect()->route('admin.dashboard')->with('categorie-success', 'Catégorie supprimée avec succès');
    }

/*************************  PRODUCT  ********************************************************************/

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

            $filename = $filenameWithExt . '_' . time() . '.' . $extension;

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
        $product = Product::findOrFail($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Categorie::all();


        return view('admin.edit', compact('product', 'categories'));
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
        $product->categorie_id = $request->input('categorie_id');

        if ($request->hasFile('image')) {
            // Delete the old image file (optional)
            Storage::delete($product->image);


            $imagePath = $request->file('image')->store('uploads', 'public');

            $imageName = basename($imagePath);


            $product->image = $imageName;
        }

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
