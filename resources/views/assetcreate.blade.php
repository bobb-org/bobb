@extends('layouts.app')

@section('content')
@if( Auth::user()->role == 'superadmin' || Auth::user()->role == 'kierownik_projektu')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading" style="font-size:30px;">Dodawanie pliku
                    <div style="float:right;">
                        <a href="/asset/{{ $id_realization }}">&#10006;</a>
                    </div>
                </div>
                
                    <form action="{{ action('AssetController@store') }}" method="POST" role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        
                        <input type="hidden" class="form-control" name="id_realization" value="{{ $id_realization }}"/>
                        <label for="name">Nazwa pliku</label>
                        <input type="text" class="form-control" name="name"/>
                        <input type="hidden" class="form-control" name="urn" value="dXJuOmFkc2sub2JqZWN0czpvcy5vYmplY3Q6c3ZmX3NhbXB"/>
                    </div>
                    <input type="submit" value="Dodaj" class="btn btn-primary"/>
            </div>
        </div>
    </div>
</div>
@else
    <script>window.location = "/home";</script>
@endif
@endsection
