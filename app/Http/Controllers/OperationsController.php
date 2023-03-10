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
        $categoryId = '';
        $yearVal = '';

        $operations = Operations::all();
        $categories = Categories::all();

        $total = DB::table('operations')->sum('operationSomme');
        $data = DB::table('operations')->get();

        $operations = Operations::orderBy('created_at', 'desc')->paginate(15);


        return view('operations.index', compact('operations', 'categories', 'total', 'categoryId', 'yearVal'));
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
        $yearVal = null; // Définition de la valeur par défaut de $year

        // récupère toutes les opérations
        $operations = Operations::all();

        // récupère toutes les catégories
        $categories = Categories::all();
        $total = DB::table('operations')->sum('operationSomme');


        // récupère l'id de la catégorie sélectionnée dans le formulaire
        $category = $request->input('category');
        $categoryId = intval($category);

        $operations = Operations::orderBy('created_at', 'desc')->paginate(15);


        if ($category) {
            // filtre les opérations par catégorie
            $operations = Operations::where('category_id', $category)->orderBy('category_id', 'desc')->paginate(15);
            $total = Operations::where('category_id', $category)->sum('operationSomme');
        }

        return view('operations.index', compact('operations', 'categories', 'total', 'categoryId', 'yearVal'));
    }

    public function filterYear(Request $request)
    {
        // dd('toto');
        $categoryId = null; // Définition de la valeur par défaut de $year

        // récupère toutes les opérations
        $operations = Operations::all();

        // récupère toutes les catégories
        $categories = Categories::all();
        $total = DB::table('operations')->sum('operationSomme');


        // récupère l'année sélectionnée dans le formulaire
        $year = $request->input('year');
        $yearVal = intval($year);

        if ($year) {
            // filtre les opérations par année
            $operations = Operations::whereYear('operationDate', '=', $year)->orderBy('operationDate', 'desc')->paginate(15);
            $total = Operations::whereYear('operationDate', '=', $year)->sum('operationSomme');
        }

        return view('operations.index', compact('operations', 'categories', 'total', 'year', 'yearVal', 'categoryId'));
    }

    public function filterMonth(Request $request)
    {
        $categoryId = null; // Définition de la valeur par défaut de $year
        $yearVal = null;
        
        // récupère toutes les opérations
        $operations = Operations::all();

        // récupère toutes les catégories
        $categories = Categories::all();

        // calcule le total des opérations
        $total = DB::table('operations')->sum('operationSomme');

        // récupère le mois sélectionné dans le formulaire
        $month = $request->input('month');

        $monthVal = intval($month);

// dd($month);
        if ($month) {
            // transforme la date du mois sélectionné en format "Y-m"
            $monthFormatted = Carbon::parse($month)->format('Y-m');

            // filtre les opérations par mois
            $operations = Operations::whereMonth('operationDate', '=', $monthFormatted)->orderBy('operationDate', 'desc')->paginate(15);
            // dd($operations);
            // calcule le total des opérations pour le mois sélectionné
            $total = Operations::whereMonth('operationDate', '=', $monthFormatted)->sum('operationSomme');
        }

        return view('operations.index', compact('operations', 'categories', 'total', 'month', 'categoryId'));
    }

    function pdf(Request $request)
    {


        $operations = Operations::all();
        $categories = Categories::all();

        $total = DB::table('operations')->sum('operationSomme');
        $data = DB::table('operations')->get();

        $year = null; // Définition de la valeur par défaut de $year

        if ($request->input('category')) {  
        $category = $request->input('category');
            // filtre les opérations par catégorie
            $operations = Operations::where('category_id', $category)->orderBy('category_id', 'desc')->get();
            $total = Operations::where('category_id', $category)->sum('operationSomme');
        }

        if ($request->input('year')) {
        $year = $request->input('year');
            // filtre les opérations par année
            $operations = Operations::whereYear('operationDate', '=', $year)->orderBy('operationDate', 'desc')->get();
            $total = Operations::whereYear('operationDate', '=', $year)->sum('operationSomme');
        }


        // return view('operations.index'
        PDF::setOptions([
            "defaultFont" => "sans-serif",
            "defaultPaperSize" => "a4",
            "dpi" => 130
        ]);

        $pdf=PDF::loadView('operations.operationsPdf', compact('operations', 'categories', 'total', 'year'));
        return $pdf->stream();
    }

}