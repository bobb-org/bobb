@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:30px;">Admin panel <div style="float:right;"> <a href="/role">&#10006;</a></div></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ action('RoleController@createuser') }}" role="form">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Imię</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('surnname') ? ' has-error' : '' }}">
                            <label for="surnname" class="col-md-4 control-label">Nazwisko</label>

                            <div class="col-md-6">
                                <input id="surnname" type="text" class="form-control" name="surnname" required autofocus>

                                @if ($errors->has('surnname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surnname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adres e-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Hasło</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">Uprawnienia</label>

                            <div class="col-md-6">
                                <select name="role"class="form-control">
                                    <option selected value="pracownik">pracownik</option>
                                    <option value="inzynier">inzynier</option>
                                    <option value="kierownik_projektu">kierownik_projektu</option>
                                    <option value="superadmin">superadmin</option>
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                            <label for="company" class="col-md-4 control-label">Nazwa Firmy</label>

                            <div class="col-md-6">
                                <input id="company" type="text" class="form-control" name="company" required autofocus>

                                @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Numer tel.</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control" name="phone" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Dodaj
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
