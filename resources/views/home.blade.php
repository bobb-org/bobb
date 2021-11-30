@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading" style="font-size:30px;">Twoje realizacje
                @if( Auth::user()->role == 'superadmin' || Auth::user()->role == 'kierownik_projektu')
                    <div style="float:right;"><a href="/homecreate">&#10010;</a></div>
                @endif
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @foreach ($realizationList as $realization) 
                        
                        <div style=" float:left;padding:5px; text-align: center;"><a href="/asset/{{ $realization->id_realization }}"><div style="font-size:50px;">&#128448;</div></a>{{ $realization->name }}</div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
