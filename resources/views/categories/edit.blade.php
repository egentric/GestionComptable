@extends('layouts/app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Modifier une catégorie</h4>
    </div>
    <div class="card-body">
        <h5 class="card-title">Formulaire de modification</h5>

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
        <form method="POST" action="{{ route('categories.update', $categories->id) }}">
            @csrf
            @method('PATCH')

            <p class="card-text">

            <div class="row g-3">

                <div class="col">
                    <input type="text" class="form-control" name="categoryName" value="{{ $categories->categoryName }}">
                </div>
            </div>
            </p>
            <button type="submit" class="btn btn-primary rounded-pill shadow-sm">
                mettre à jour </button>
        </form>
    </div>
</div>


@endsection