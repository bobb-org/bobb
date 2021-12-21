@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            
                <div class="panel-heading" style="font-size:30px;">Twoje assety <div style="float:right;">
                
                    @if( Auth::user()->role == 'superadmin' || Auth::user()->role == 'kierownik_projektu')
                        
                        <a href="/memberaddform/{{ $assetid }}">&#x1F464;</a> 
                        <a href="/assetcreate/{{ $assetid }}"> &#10010;</a> 

                    @endif
                            <a href="/home">&#10006;</a>
                        </div>
                </div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($assetList as $asset)
                        <div style=" float:left;padding:5px; text-align: center;">
                        @if( Auth::user()->role == 'superadmin' || Auth::user()->role == 'kierownik_projektu' || Auth::user()->role == 'inzynier')
                            <a href="/assetshow/{{ $asset->id_asset }}"><div style="font-size:50px;">&#10066;</div></a>
                        @else
                            <div style="font-size:50px;">&#10066;</div>
                        @endif
                            {{ $asset['name'] }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
