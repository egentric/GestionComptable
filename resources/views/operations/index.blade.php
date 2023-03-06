    @extends('layouts/app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Opérations</h4>
    </div>
    <div class="card-body">
        <h5 class="card-title">Listes des opérations</h5>

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
                        <th scope="col">Date</th>
                        <th scope="col">Nature de l'opération</th>
                        <th scope="col">Catégorie de l'opération</th>
                        <th scope="col">Débit</th>
                        <th scope="col">Crédit</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($operations as $operation)
                    <tr>
                        <td>{{$operation->operationDate}}</td>
                        <td>{{$operation->operationDescription}}</td>
                        {{-- @dump($operation->category->categoryName) --}}
                        <td>{{$operation->category->categoryName}}</td>
                        <td>
                            @if ($operation->operationSomme<0)
                            {{$operation->operationSomme}} €
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            @if ($operation->operationSomme>=0)
                            {{$operation->operationSomme}} €
                            @else
                            -
                        @endif
                        </td>
                        <td>
                            <a href="{{ route('operations.edit', $operation->id)}}" class="btn btn-primary btn-sm"">Editer</a>
                            <form action="{{ route('operations.destroy', $operation->id)}}" method="POST" style="display: inline-block">
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
            <a href="{{ route('operations.create')}}" class="btn btn-primary">Créer</a>
        </div>
    </div>


    @endsection