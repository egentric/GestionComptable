@extends('layouts/app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Modifier une opération</h4>
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
        <form method="POST" action="{{ route('operations.update', $operations->id) }}">
            @csrf
            @method('PATCH')

            <p class="card-text">

            <div class="row g-3">

                <div class="col-3">
                    <input type="date" class="form-control" value="{{ $operations->operationDate }}" name="operationDate">
                </div>
                <div class="col-3">
                    <input type="number" class="form-control" value="{{ $operations->operationSomme }}" name="operationSomme">
                </div>
                <div class="col-6">
                    {{-- <input type="text" class="form-control" placeholder="Description" name="operationDescription"> --}}
                </div>

                <div class="col-12">
                    <label>Nature de l'opération</label>
                    <input type="text" class="form-control" value="{{ $operations->operationDescription }}"  name="operationDescription">
                </div>

            </div>
            </p>
            <button type="submit" class="btn btn-primary rounded-pill shadow-sm">
                Modifier une opération </button>
        </form>
    </div>
</div>


@endsection