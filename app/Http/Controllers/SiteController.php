<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites =Site::all();
        return view('site.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('site.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siteTitle' => 'required',
            'siteDescription' =>'required',
            'siteXlPicture' =>'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'siteSmPicture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $filename1 = "";
        if ($request->hasFile('siteXlPicture')) {
        // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
        $filenameWithExt = $request->file('siteXlPicture')->getClientOriginalName();
        $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // On récupère l'extension du fichier, résultat $extension : ".jpg"
        $extension = $request->file('siteXlPicture')->getClientOriginalExtension();
        // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $filename :"jeanmiche_20220422.jpg"
        $filename1 = $filenameWithExt. '_' .time().'.'.$extension;
        // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin/storage/app
        $request->file('siteXlPicture')->storeAs('public/uploads', $filename1);
        } else {
        $filename1 = Null;
        }

        $filename2 = "";
        if ($request->hasFile('siteSmPicture')) {
        // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
        $filenameWithExt = $request->file('siteSmPicture')->getClientOriginalName();
        $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // On récupère l'extension du fichier, résultat $extension : ".jpg"
        $extension = $request->file('siteSmPicture')->getClientOriginalExtension();
        // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $filename :"jeanmiche_20220422.jpg"
        $filename2 = $filenameWithExt. '_' .time().'.'.$extension;
        // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin/storage/app
        $request->file('siteSmPicture')->storeAs('public/uploads', $filename2);
        } else {
        $filename2 = Null;
        }

        Site::create([
            'siteTitle' => $request->siteTitle,
            'siteDescription' => $request->siteDescription,
            'siteXlPicture' => $filename1,
            'siteSmPicture' => $filename2,
        ]);

        return redirect()->route('site.index')
        ->with('success', 'Accueil ajouté avec succès!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sites = Site::findOrFail($id);

        return view('site.show', compact('sites'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sites = Site::findOrfail($id);
        return view('site.edit', compact('sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateSite = $request->validate([
            'siteTitle' => 'required',
            'siteDescription' =>'required',
            'siteXlPicture' =>'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'siteSmPicture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $filename1 = "";
        if ($request->hasFile('siteXlPicture')) {
        // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
        $filenameWithExt = $request->file('siteXlPicture')->getClientOriginalName();
        $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // On récupère l'extension du fichier, résultat $extension : ".jpg"
        $extension = $request->file('siteXlPicture')->getClientOriginalExtension();
        // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $filename :"jeanmiche_20220422.jpg"
        $filename1 = $filenameWithExt. '_' .time().'.'.$extension;
        // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin/storage/app
        $request->file('siteXlPicture')->storeAs('public/uploads', $filename1);
        $updateSite['siteXlPicture'] = $filename1;
         }
         $filename2 = "";
         if ($request->hasFile('siteSmPicture')) {
         // On récupère le nom du fichier avec son extension, résultat $filenameWithExt : "jeanmiche.jpg"
         $filenameWithExt = $request->file('siteSmPicture')->getClientOriginalName();
         $filenameWithExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);
         // On récupère l'extension du fichier, résultat $extension : ".jpg"
         $extension = $request->file('siteSmPicture')->getClientOriginalExtension();
         // On créer un nouveau fichier avec le nom + une date + l'extension, résultat $filename :"jeanmiche_20220422.jpg"
         $filename2 = $filenameWithExt. '_' .time().'.'.$extension;
         // On enregistre le fichier à la racine /storage/app/public/uploads, ici la méthode storeAs défini déjà le chemin/storage/app
         $request->file('siteSmPicture')->storeAs('public/uploads', $filename2);
         $updateSite['siteSmPicture'] = $filename2;
        }


        Site::whereId($id)->update($updateSite);

        return redirect()->route('site.show', [$id])
            ->with('success', 'L\'accueil est mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sites = Site::findOrFail($id);
        $sites->delete();
        return redirect('/site')->with('success', 'Accueil supprimé avec succès');
    }
}
