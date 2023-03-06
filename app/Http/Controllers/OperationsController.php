<?php

namespace App\Http\Controllers;

use App\Models\Operations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operations =Operations::all();
        return view('operations.index', compact('operations'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'operationDescription' => 'required',
            'operationDate' => 'required',
            'operationSomme' => 'required'

        ]);

        Operations::create([
            'operationDescription' => $request->operationDescription,
            'operationDate' =>$request->operationDate,
            'operationSomme'=>$request->operationSomme
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
        return view('operations.edit', compact('operations'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateOperation = $request->validate([
            'operationDescription' => 'Required',
            'operationDate' =>'Required',
            'operationSomme'=>'Required'
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
}
