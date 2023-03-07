@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

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
            <div class=" table-responsive">

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
                            <a href="{{ route('categories.edit', $category->id)}}" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Editer</a>
                            <form action="{{ route('categories.destroy', $category->id)}}" method="POST" style="display: inline-block">
                        @csrf
                        @method('delete')
                        <button class=" btn btnRed btn-sm" type="submit"><i class="bi bi-trash3"></i> Supprimer</button>
                        </form> 
                
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            </p>
            <a href="{{ route('categories.create') }}" class="btn btnYellow"><i class="bi bi-file-earmark-plus"></i> Créer</a>
        </div>
    </div>
</div>

    @endsection