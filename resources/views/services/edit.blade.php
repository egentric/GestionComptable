@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

<div class="card">
    <div class="card-header">
        <h4>Modifier une prestation</h4>
    </div>
    <div class="card-body">
        <h5 class="card-title">Formulaire de modification</h5>

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
        <form method="POST" action="{{ route('services.update', $services->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <p class="card-text">

            <div class="row g-3">

                <div class="col-12">
                    <input type="text" class="form-control" name="serviceTitle" value="{{ $services->serviceTitle }}">
                </div>
                <div class="col-12">
                    {{-- <input type="text" class="form-control" name="siteDescription" value="{{ $sites->siteDescription }}"> --}}
                    <textarea class="form-control" id="editor" name="serviceDescription" value="{{ $services->serviceDescription }}">{{ $services->serviceDescription }}</textarea>
                    {{ csrf_field() }}
                </div>
                <div class="form-group col-sm-6">
                    <label for="picture" class="form-label">Photo</label>
                    <input type="file" class="form-control" name="servicePicture" id="servicePicture">
                    </div>
                </div>
            </p>
            <button type="submit" class="btn btnYellow shadow-sm">
                <i class="bi bi-save2 "></i> Mettre à jour </button>
                <a href="{{ route('services.index')}}" class="btn btnGris"><i class="bi bi-arrow-return-left"></i> Retour liste</a>
        </form>
    </div>
</div>
</div>

@endsection