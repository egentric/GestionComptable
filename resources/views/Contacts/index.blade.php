@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

<div class="card">
    <div class="card-header">
        <h4>Contacts</h4>
    </div>
    <div class="card-body">
        <h5 class="card-title">Listes des contacts</h5>

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
                        <th scope="col">e-mail</th>
                        <th scope="col">Sujet</th>
                        <th scope="col">Description</th>

                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{$contact->contactEmail}}</td>
                        <td>{{$contact->contactTopic}}</td>
                        <td>{{$contact->contactDescription}}</td>
                        <td>
                            <a href="{{ route('contacts.show', $contact->id)}}" class="btn btnGris btn-sm""><i class="bi bi-eye icone"></i> Voir</a>
                            {{-- <a href="{{ route('contacts.edit', $contact->id)}}" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Editer</a> --}}
                            <form action="{{ route('contacts.destroy', $contact->id)}}" method="POST" style="display: inline-block">
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
            {{-- <a href="{{ route('categories.create') }}" class="btn btnYellow"><i class="bi bi-file-earmark-plus"></i> Créer</a> --}}
        </div>
    </div>
</div>

    @endsection