@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

    <div class="card">
        <div class="card-header">
            <h4>Utilisateurs</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">Liste des utilisateurs</h5>

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
            <p class="card-text">

                <!-- Tableau -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Nom</th>
                            <th scope="col">email</th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>

                            <td>{{$user->pseudo}}</td>
                            <td>{{$user->firstname}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            {{-- <td>
                                <a href="{{ route('users.show', $user->id)}}" class="btn btnGris btn-sm">Voir</a>
                                <a href="{{ route('articles.edit', $article->id)}}" class="btn btn-primary btn-sm">Editer</a>
                                <form action="{{ route('users.destroy', $user->id)}}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btnRed btn-sm"" type=" submit">Supprimer</button>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Fin du Tableau -->
            </p>
        </div>
    </div>

</div>

@endsection