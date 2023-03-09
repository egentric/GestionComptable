@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

<div class="card">
    <div class="card-header">
        <h4>Préstation</h4>
    </div>
    <div class="card-body">
        <h5 class="card-title">Listes des prestations</h5>

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
                        <th scope="col">Prestations</th>
                        <th scope="col">Descriptions</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{$service->serviceTitle}}</td>
                        <td>{{$service->serviceDescription}}</td>

                        <td>
                            <a href="{{ route('services.show', $service->id)}}" class="btn btnGris btn-sm""><i class="bi bi-eye icone"></i> Voir</a>
                            <a href="{{ route('services.edit', $service->id)}}" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Editer</a>
                            <form action="{{ route('services.destroy', $service->id)}}" method="POST" style="display: inline-block">
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
            <a href="{{ route('services.create') }}" class="btn btnYellow"><i class="bi bi-file-earmark-plus"></i> Créer</a>
        </div>
    </div>
</div>

    @endsection