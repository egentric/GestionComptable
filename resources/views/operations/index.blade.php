    @extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

<div class="card">
    <div class="card-header">
        <h4>Opérations</h4>
    </div>
    <div class="card-body">
        <h5 class="card-title">Listes des opérations</h5>
        <div>
            <form method="GET" action="{{ route('filterCategory') }}">
                <div class="row">
                    <div class="col-4">

                        <select class="form-select" aria-label="select Catégories" name="category">
                            <option disabled selected>Filtrer par catégorie</option>
                            
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->categoryName}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-2">
                        <button type="submit" class="btnGris">
                            <i class="bi bi-funnel"></i>
                            Filtrer</button>
                    </div>
                </form>
            {{-- <a href="#" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Date</a>
            <a href="#" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Catégorie</a> --}}
            {{-- <a href="#" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Editer</a> --}}

        </div>

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
                            <a href="{{ route('operations.edit', $operation->id)}}" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Editer</a>
                            <form action="{{ route('operations.destroy', $operation->id)}}" method="POST" style="display: inline-block">
                        @csrf
                        @method('delete')
                        <button class=" btn btnRed btn-sm" type="submit"><i class="bi bi-trash3"></i> Supprimer</button>
                        </form> 
                
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>Total :</th>
                        <td colspan="2">
                            @if($total >= 0)
                                {{ $total }} €
                            @else
                               <div class="neg"> {{ $total }} € </div>
                            @endif
                        <td>
                    </tr>
                </tfoot>
            </table>
            </div>
            </p>
            <a href="{{ route('operations.create')}}" class="btn btnYellow"><i class="bi bi-file-earmark-plus"></i> Créer</a>
        </div>
    </div>
</div>

    @endsection