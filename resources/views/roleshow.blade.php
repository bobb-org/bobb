@extends('layouts.app')

@section('content')
@if( Auth::user()->role == 'superadmin' || Auth::user()->role == 'kierownik_projektu')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:30px;">Admin panel <div style="float:right;"> <a href="/home">&#10006;</a></div></div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th><th>Imie</th> <th>Nazwisko</th> <th>mail</th>  
                            </tr>
                        </thead>
                        <tbody>
                        
                            
                                <tr>
                                    @foreach ($userList as $user)
                                        <td >{{ $user->id }}</td><td >{{ $user->name }}</td> <td>{{ $user->surnname }}</td> <td>{{ $user->email }}</td>
                                    @endforeach
                                    
                                    <td>
                                    
                                        <form action="{{ action('RoleController@updateuser') }}" method="POST" role="form">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="id" value="{{ $user->id }}" />
                                        <div class="form-group">
                                            <select name="role" >
                                                            <option selected value="{{ $user->role }}">{{ $user->role }}</option>
                                                            <option value="pracownik">pracownik</option>
                                                            <option value="inzynier">inzynier</option>
                                                            <option value="kierownik_projektu">kierownik_projektu</option>
                                                            @if(Auth::user()->role == 'superadmin')
                                                                <option value="superadmin">superadmin</option>
                                                            @endif
                                            </select>
                                            <input type="text" name="name" value="{{ $user->name }}" />
                                            <input type="text" name="surnname" value="{{ $user->surnname }}" />
                                            <input type="text" name="email" value="{{ $user->email }}" />
                                        </div>

                                        <input type="submit" value="Aktualizuj" class="btn btn-primary"/>
                                    </td>
                                </tr>
                                
                                
                   
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
