<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Contacts;
use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites =Site::all();
        $services =Services::all();

        return view('welcome', compact('sites', 'services'));

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
    public function store(Request $request)
    {
        $request->validate([
            'contactEmail' => 'required',
            'contactTopic' =>'required',
            'contactDescription' =>'required',
        ]);

        Contacts::create([
            'contactEmail' => $request->contactEmail,
            'contactTopic' => $request->contactTopic,
            'contactDescription' => $request->contactDescription,
        ]);

        return redirect()->route('welcome')
        ->with('success', 'E-mail envoyé avec succès!');
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
}
