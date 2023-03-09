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
                <thead>
                    <tr>
                        <th scope="col">Titre</th>
                        <th scope="col">Decription</th>
                        {{-- <th scope="col">Grande Photo</th>
                       <th scope="col">Petite Photo</th> --}}
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sites as $site)
                    <tr>
                        <td>{{$site->siteTitle}}</td>
                        <td>{{$site->siteDescription}}</td>
                        {{-- <td>{{$site->siteXlPicture}}</td>
                        <td>{{$site->siteSmPicture}}</td> --}}
                        <td>
                            <a href="{{ route('site.show', $site->id)}}" class="btn btnGris btn-sm""><i class="bi bi-eye icone"></i> Voir</a>
                            <a href="{{ route('site.edit', $site->id)}}" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Editer</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            </p>
        </div>
    </div>
</div>

    @endsection