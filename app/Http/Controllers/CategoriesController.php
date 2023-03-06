<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Contracts\Service\Attribute\Required;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $categories =Categories::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoryName' => 'required'
        ]);

        Categories::create([
            'categoryName' => $request->categoryName,
        ]);

        return redirect()->route('categories.index')
                        ->with('success', 'Categorie ajouté avec succès!');
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
        $categories = Categories::findOrfail($id);
        return view('categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateCategories = $request->validate([
            'categoryName' => 'Required'
        ]);

        Categories::whereId($id)->update($updateCategories);
        return redirect()->route('categories.index')
                        ->with('success', 'La catégorie a été mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Categories::findOrFail($id);
        $categories->delete();
        return redirect('/categories')->with('success', 'Catégorie supprimé avec succès');
    }
}
