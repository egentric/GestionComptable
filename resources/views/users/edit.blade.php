@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

    <div class="card">
        <div class="card-header">
            <h4>Mon Compte</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">Modifier mes informations</h5>

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
            <form method="post" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <p class="card-text">

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Pseudo</label>
                            <input required type="text" name="pseudo" class="form-control" value="{{ $user->pseudo }}" id='pseudo'>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>e-mail</label>
                            <input required type="text" name="email" class="form-control" value="{{ $user->email }}" id='email'>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>prénom</label>
                                <input required type="text" name="firstname" class="form-control" value="{{ $user->firstname }}" id='firstName'>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nom</label>
                                <input required type="text" name="name" class="form-control" value="{{ $user->name }}" id='name'>
                            </div>
                        </div>
                    </div>


                </div>
                </p>


                <div class="form-group col-sm-8">
                    <button type="submit" class="btn btnYellow rounded-pillshadow-sm"><i class="bi bi-save2 "></i> Mettre à jour</button>
            </form>

            <form action="{{route('users.destroy', $user)}}" method="post">
                @CSRF
                @method('delete')
                <button type="submit" class=" mt-3 btn btnRed">Supprimer le compte</button>
            </form>
        </div>
    </div>
    <!-- Fin du formulaire -->
</div>

@endsection