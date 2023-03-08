<?php

namespace App\Http\Controllers;
use PDF;
// use Barryvdh\DomPDF\PDF;
use App\Models\Categories;
use App\Models\Operations;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
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
        $data = DB::table('operations')->get();

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

    public function filterYear(Request $request)
    {
        // dd('toto');

        // récupère toutes les opérations
        $operations = Operations::all();

        // récupère toutes les catégories
        $categories = Categories::all();
        $total = DB::table('operations')->sum('operationSomme');


        // récupère l'année sélectionnée dans le formulaire
        $year = $request->input('year');

        if ($year) {
            // filtre les opérations par année
            $operations = Operations::whereYear('operationDate', '=', $year)->orderBy('operationDate', 'desc')->get();
            $total = Operations::whereYear('operationDate', '=', $year)->sum('operationSomme');
        }

        return view('operations.index', compact('operations', 'categories', 'total', 'year'));
    }

    public function filterMonth(Request $request)
    {
        // récupère toutes les opérations
        $operations = Operations::all();

        // récupère toutes les catégories
        $categories = Categories::all();

        // calcule le total des opérations
        $total = DB::table('operations')->sum('operationSomme');

        // récupère le mois sélectionné dans le formulaire
        $month = $request->input('month');

        if ($month) {
            // transforme la date du mois sélectionné en format "Y-m"
            $monthFormatted = Carbon::parse($month)->format('Y-m');

            // filtre les opérations par mois
            $operations = Operations::whereMonth('operationDate', '=', $monthFormatted)->orderBy('operationDate', 'desc')->get();
            // dd($operations);
            // calcule le total des opérations pour le mois sélectionné
            $total = Operations::whereMonth('operationDate', '=', $monthFormatted)->sum('operationSomme');
        }

        return view('operations.index', compact('operations', 'categories', 'total', 'month'));
    }

    function pdf()
    {
        $operations = Operations::all();
        $categories = Categories::all();

        $total = DB::table('operations')->sum('operationSomme');
        $data = DB::table('operations')->get();

        // return view('operations.index'
        PDF::setOptions([
            "defaultFont" => "sans-serif",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $pdf=PDF::loadView('operations.index', compact('operations', 'categories', 'total'));
        return $pdf->stream();
    }

}
