@extends('layouts/app')

@section('content')
<div class="col-lg-8 mx-auto mt-4">

    <div class="card">
        <div class="card-header">
            <h4>Contact</h4>
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
                                <th>e-mail</th>
                                <td>{{$contacts->contactEmail}}</td>
                            </tr>
                            <tr>
                                <th>Sujet</th>
                                <td>{{$contacts->contactEmail}}</td>
                            </tr>Topic
                            <tr>
                                <th>Description</th>
                                <td>{{$contacts->contactDescription}}</td>
                            </tr>
                            <tr>
                                <th>Action</th>
                                <td><a href="{{ route('contacts.index')}}" class="btn btnGris"><i class="bi bi-arrow-return-left"></i> Retour liste</a>
                                    {{-- <a href="{{ route('contacts.edit', $contacts->id)}}" class="btn btnGris btn-sm""><i class="bi bi-pencil-square"></i> Editer</a> --}}
                                    <form action="{{ route('contacts.destroy', $contacts->id)}}" method="POST" style="display: inline-block">
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