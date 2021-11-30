@extends('layouts.app')

@section('content')
@if( Auth::user()->role == 'superadmin' || Auth::user()->role == 'kierownik_projektu')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading" style="font-size:30px;">Dodawanie realizacji
                    <div style="float:right;">
                        <a href="/home">&#10006;</a>
                    </div>
                </div>
                
                    <form action="{{ action('HomeController@store') }}" method="POST" role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id" value="{{ Auth::user()->id }}"/>
                        <label for="name">Nazwa realizacji</label>
                        <input type="text" class="form-control" name="name"/>
                        <label for="city">Miasta</label>
                        <input type="text" class="form-control" name="city"/>
                        <label for="street">Ulica</label>
                        <input type="text" class="form-control" name="street"/>
                        <label for="integer">Numer</label>
                        <input type="text" class="form-control" name="number"/>
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
