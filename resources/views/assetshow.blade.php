@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:30px;">Asset details <div style="float:right;"> 
                @foreach ($assetList2 as $asset)@endforeach
                        <a href="/forge/{{$asset->urn}}"><button type="button" class="btn btn-success">Uruchom DWG</button></a>
                        <a href="/home">&#10006;</a></div></div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <table>
                        <thead>
                            <tr>
                            <th>ID asset</th><th>ID Realizacj</th><th>Nazwa Assetu</th> <th>URN</th> 
                            </tr>
                        </thead>
                        <tbody>
                        
                            
                                <tr>
                                    @foreach ($assetList2 as $asset)
                                    <td >{{ $asset->id_asset }}</td><td >{{ $asset->id_realization }}</td><td >{{ $asset->name }}</td> <td>{{ $asset->urn }}</td>
                                    @endforeach
                                    
                                    
                                </tr>
                                
                                
                   
                        </tbody>
                    </table>
                    
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
