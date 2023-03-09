@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

    <div class="card">
        <div class="card-header">
            <h4>Accueil Site</h4>
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
                                <td>{{$sites->siteTitle}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{$sites->siteDescription}}</td>
                            </tr>
                            <tr>
                                <th>Grande Photo</th>
                                @if($sites->siteXlPicture)
                                <td>
                                    <img src="/storage/uploads/{{$sites->siteXlPicture}}" alt="" width="100"></br>
                                    {{$sites->siteXlPicture}}
                                </td>
                                @endif
                            </tr>
                            <tr>
                                <th>Petite Photo</th>
                                @if($sites->siteSmPicture)
                                <td>
                                    <img src="/storage/uploads/{{$sites->siteSmPicture}}" alt="" width="100"></br>
                                    {{$sites->siteSmPicture}}
                                </td>
                                @endif
                            </tr>
                            <tr>
                                <th>Action</th>
                                <td><a href="{{ route('site.index')}}" class="btn btnGris"><i class="bi bi-arrow-return-left"></i> Retour liste</a>
                                    <a href="{{ route('site.edit', $sites->id)}}" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Editer</a>
                                    {{-- <form action="{{ route('site.destroy', $site->id)}}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"" type=" submit">Supprimer</button> --}}
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