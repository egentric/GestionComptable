@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="bi bi-cash-coin"></i> Gestion Comptable</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('operations.index')}}" class="nav-link px-0 menubis ms-2">
                            <i class="bi bi-plus-slash-minus"></i>
                            <span class="d-none d-sm-inline">Opérations
                        </a>
                        <a href="{{ route('categories.index')}}" class="nav-link px-0 menubis ms-2">
                            <i class="bi bi-bookmarks"></i>
                            <span class="d-none d-sm-inline">Catégories</span>
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="bi bi-browser-chrome"></i> Gestion du Site</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('site.index')}}" class="nav-link px-0 menubis2 ms-2">
                            <i class="bi bi-house"></i>
                            <span class="d-none d-sm-inline">Accueil</span>
                        </a>

                        <a href="{{ route('services.index')}}" class="nav-link px-0 menubis2 ms-2">
                            <i class="bi bi-back"></i>
                            <span class="d-none d-sm-inline">Prestations</span>
                        </a>
                        <a href="{{ route('contacts.index')}}" class="nav-link px-0 menubis2 ms-2">
                            <i class="bi bi-envelope-at"></i>
                            <span class="d-none d-sm-inline">Contacts</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <a href="{{ route('users.index')}}">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fs-4 bi-people"></i> Utilisateur</h4>
                    </div>
                    <div class="card-body">
                    <table class="table">
                            <thead>
                                <tr>
                                    <th>Pseudo</th>
                                    <th>e-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->pseudo}}</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 mt-4">
            <a href="{{ route('users.edit', $user = Auth::user())}}">

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fs-4 bi bi-person"></i> Mon Compte</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Pseudo</th>
                                    <th>e-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$user->pseudo}}</td>
                                    <td>{{$user->email}}</td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </a>
            </div>

        </div>
    </div>
</div>
@endsection