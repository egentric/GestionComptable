@extends('layouts/app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Ajouter une catégorie</h4>
    </div>
    <div class="card-body">
        <h5 class="card-title">Formulaire d'Ajout</h5>

        <!-- Message d'information -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulaire -->
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <p class="card-text">

            <div class="row g-3">

                <div class="col">
                    <input type="text" class="form-control" placeholder="Nouvelle Catégorie" name="categoryName">
                </div>
            </div>
            </p>
            <button type="submit" class="btn btn-primary rounded-pill shadow-sm">
                Ajouter une catégorie </button>
        </form>
    </div>
</div>


@endsection