@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:30px;">Dodaj członka do realizacji <div style="float:right;"> <a href="/home">&#10006;</a></div></div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ action('MemberController@store') }}" method="POST" role="form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="id_realization" value="{{ $id_realization }}" />
                    
                    <div class="form-group">
                        <select name="id" >
                            @foreach ($userList as $user)
                                
                                <option selected value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach                                    
                        </select>
                        <input type="submit" value="Dodaj do realizacji" class="btn btn-primary"/>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
