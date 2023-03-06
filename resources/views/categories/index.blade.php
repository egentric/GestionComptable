@extends('layouts/app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Catégorie</h4>
    </div>
    <div class="card-body">
        <h5 class="card-title">Listes des catégories</h5>

        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
        @endif

        <p class="card-text">
        <div class="row g-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nom de la catégorie</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->categoryName}}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-primary btn-sm"">Editer</a>
                            <form action="{{ route('categories.destroy', $category->id)}}" method="POST" style="display: inline-block">
                        @csrf
                        @method('delete')
                        <button class=" btn btn-danger btn-sm" type="submit">Supprimer</button>
                        </form> 
                
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </p>
            <a href="#" class="btn btn-primary">Créer</a>
        </div>
    </div>


    @endsection