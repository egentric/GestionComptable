@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

<div class="card">
    <div class="card-header">
        <h4>Modifier l'Accueil</h4>
    </div>
    <div class="card-body">

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
        <form method="POST" action="{{ route('site.store') }}" enctype="multipart/form-data">
            @csrf

            <p class="card-text">

            <div class="row g-3">

                <div class="col-12">
                    <input type="text" class="form-control" name="siteTitle" placeholder='Titre'>
                </div>
                <div class="col-12">
                    {{-- <input type="text" class="form-control" name="siteDescription" placeholder='Description'> --}}
                    <textarea class="form-control" id="editor" name="siteDescription" placeholder='Description'></textarea>
                    {{ csrf_field() }}
                </div>
                <div class="form-group col-sm-6">
                    <label for="picture" class="form-label">Grande photo</label>
                    <input type="file" class="form-control" name="siteXlPicture" id="siteXlPicture">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="picture" class="form-label">Photo à propos</label>
                    <input type="file" class="form-control" name="siteSmPicture" id="siteSmPicture">
                    </div>
                </div>

            </div>
            </p>
            <button type="submit" class="btn btnYellow shadow-sm">
                <i class="bi bi-file-earmark-plus"></i> Ajouter</button>
                <a href="{{ route('site.index')}}" class="btn btnGris"><i class="bi bi-arrow-return-left"></i> Retour liste</a>
        </form>
    </div>
</div>
</div>

@endsection