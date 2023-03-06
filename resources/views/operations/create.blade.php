@extends('layouts/app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Ajouter une opération</h4>
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
        <form method="POST" action="{{ route('operations.store') }}">
            @csrf

            <p class="card-text">

            <div class="row g-3">

                <div class="col-3">
                    <input type="date" class="form-control" placeholder="Date" name="operationDate">
                </div>
                <div class="col-3">
                    <input type="number" class="form-control" placeholder="Somme" name="operationSomme">
                </div>
                <div class="col-6">
                    {{-- <input type="text" class="form-control" placeholder="Description" name="operationDescription"> --}}
                </div>

                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Description" name="operationDescription">
                </div>

            </div>
            </p>
            <button type="submit" class="btn btn-primary rounded-pill shadow-sm">
                Ajouter une opération </button>
        </form>
    </div>
</div>


@endsection