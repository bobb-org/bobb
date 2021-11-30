@extends('layouts.app')

@section('content')
@if( Auth::user()->role == 'superadmin')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:30px;">Admin panel <div style="float:right;"><a href="/rolecreate"> &#10010;</a> <a href="/home">&#10006;</a></div></div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ action('RoleController@showuser') }}" method="POST" role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        
                        <label for="email">Szukaj usera po email:</label>
                        <input type="email" class="form-control" name="email" />
                    </div>
                        <input type="submit" value="Szukaj" class="btn btn-primary"/>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th><th>Imie</th> <th>Nazwisko</th> <th>mail</th> <th>rola</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userList as $user)
                                <tr>
                                    <a href=""><td >{{ $user->id }}</td><td >{{ $user->name }}</td> <td>{{ $user->surnname }}</td> <td>{{ $user->email }}</td> <td >{{ $user->role }}</td></a>
                                </tr>
                            @endforeach    
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <script>window.location = "/home";</script>
@endif

@endsection