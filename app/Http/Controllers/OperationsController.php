<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operations = Operations::all();
        $categories = Categories::all();

        $total = DB::table('operations')->sum('operationSomme');
        // $data = DB::table('operations')->get();

        return view('operations.index', compact('operations', 'categories', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('operations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'operationDescription' => 'required',
            'operationDate' => 'required',
            'operationSomme' => 'required',
            'category_id' => 'required'

        ]);

        Operations::create([
            'operationDescription' => $request->operationDescription,
            'operationDate' => $request->operationDate,
            'operationSomme' => $request->operationSomme,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('operations.index')
            ->with('success', 'Operation ajouté avec succès!');
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
        $operations = Operations::findOrfail($id);
        $categories = Categories::all();
        $operationCategory = $operations->category;
        // dd($operationCategory);

        return view('operations.edit', compact('operations', 'categories', 'operationCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateOperation = $request->validate([
            'operationDescription' => 'required',
            'operationDate' => 'required',
            'operationSomme' => 'required',
            // 'category_id' => 'required'
        ]);

        Operations::whereId($id)->update($updateOperation);
        return redirect()->route('operations.index')
            ->with('success', 'L\'opération a été mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $operations = Operations::findOrFail($id);
        $operations->delete();
        return redirect('/operations')->with('success', 'L\'opération a été supprimé avec succès');
    }



    public function filterCategory(Request $request)
    {
        // dd('toto');

        // récupère toutes les opérations
        $operations = Operations::all();

        // récupère toutes les catégories
        $categories = Categories::all();
        $total = DB::table('operations')->sum('operationSomme');


        // récupère l'id de la catégorie sélectionnée dans le formulaire
        $category = $request->input('category');

        if ($category) {
            // filtre les opérations par catégorie
            $operations = Operations::where('category_id', $category)->orderBy('category_id', 'desc')->get();
            $total = Operations::where('category_id', $category)->sum('operationSomme');
        }

        return view('operations.index', compact('operations', 'categories', 'total'));
    }
}
