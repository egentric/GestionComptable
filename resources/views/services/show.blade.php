@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

    <div class="card">
        <div class="card-header">
            <h4>prestation</h4>
        </div>
        <div class="card-body">

            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
            @endif

            <p class="card-text">
            <div class="row g-3">
                <div class=" table-responsive">

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Titre</th>
                                <td>{{$services->serviceTitle}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{$services->serviceDescription}}</td>
                            </tr>
                            <tr>
                                <th>Photo</th>
                                @if($services->servicePicture)
                                <td>
                                    <img src="/storage/uploads/{{$services->servicePicture}}" alt="" width="100"></br>
                                    {{$services->servicePicture}}
                                </td>
                                @endif
                            </tr>
                            <tr>
                                <th>Action</th>
                                <td><a href="{{ route('services.index')}}" class="btn btnGris"><i class="bi bi-arrow-return-left"></i> Retour liste</a>
                                    <a href="{{ route('services.edit', $services->id)}}" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Editer</a>
                                    <form action="{{ route('services.destroy', $services->id)}}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button class=" btn btnRed btn-sm" type="submit"><i class="bi bi-trash3"></i> Supprimer</button>
                                        </form> 
                                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection