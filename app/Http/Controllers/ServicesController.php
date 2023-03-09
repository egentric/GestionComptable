<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services =Services::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'serviceTitle' => 'required',
            'serviceDescription' =>'required',
            'servicePicture' =>'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = "";
        if ($request->hasFile('servicePicture')) {
        // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
        $filenameWithExt = $request->file('servicePicture')->getClientOriginalName();
        $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // On récupère l'extension du fichier, résultat $extension : ".jpg"
        $extension = $request->file('servicePicture')->getClientOriginalExtension();
        // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $filename :"jeanmiche_20220422.jpg"
        $filename = $filenameWithExt. '_' .time().'.'.$extension;
        // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin/storage/app
        $request->file('servicePicture')->storeAs('public/uploads', $filename);
        } else {
        $filename = Null;
        }


        Services::create([
            'serviceTitle' => $request->serviceTitle,
            'serviceDescription' => $request->serviceDescription,
            'servicePicture' => $filename,
        ]);

        return redirect()->route('services.index')
        ->with('success', 'Prestation ajouté avec succès!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $services = Services::findOrFail($id);

        return view('services.show', compact('services'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $services = Services::findOrfail($id);
        return view('services.edit', compact('services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateService = $request->validate([
            'serviceTitle' => 'required',
            'serviceDescription' =>'required',
            'servicePicture' =>'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $filename = "";
        if ($request->hasFile('servicePicture')) {
        // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
        $filenameWithExt = $request->file('servicePicture')->getClientOriginalName();
        $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // On récupère l'extension du fichier, résultat $extension : ".jpg"
        $extension = $request->file('servicePicture')->getClientOriginalExtension();
        // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $filename :"jeanmiche_20220422.jpg"
        $filename = $filenameWithExt. '_' .time().'.'.$extension;
        // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin/storage/app
        $request->file('servicePicture')->storeAs('public/uploads', $filename);
        $updateService['servicePicture'] = $filename;
         }
         

        Services::whereId($id)->update($updateService);

        return redirect()->route('services.show', [$id])
            ->with('success', 'La préstation est mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $services = Services::findOrFail($id);
        $services->delete();
        return redirect('/services')->with('success', 'Prestation supprimé avec succès');
    }
}
