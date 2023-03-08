<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        
        return view('users.index', compact('users'));
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
        //
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
    public function edit(User $user)
    {
       return view('users/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'pseudo' => 'required|max:40',
            'email' => 'required|string',
            'firstname' =>'nullable|string',
            'name' =>'nullable|string',
        ]);

                //on modifie les infos de l'utilisateur
                $user->pseudo = $request->input('pseudo');
                $user->email = $request->input('email');
                $user->firstName = $request->input('firstName');
                $user->name = $request->input('name');
                
                //on sauvegarde les changements en bdd
                $user->save();
                
        
                // Rediriger vers la page d'index des utilisateurs
                return redirect()->route('users.index', [$user])->with('success', 'Le compte a bien été modifié');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/register')->with('success', 'L\'utilisateur a été supprimé avec succès');

    }
}
