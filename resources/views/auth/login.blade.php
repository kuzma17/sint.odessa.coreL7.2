@extends('layouts.container3')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Авторизация</div>
                    <div class="panel-body">
                        <div class="form-group" style="border-bottom: 1px solid #cccccc">
                            <label for="email" class="col-md-4 control-label">Авторизация через соцсети</label>

                            <div class="col-md-6" style="padding: 6px">

                                <div class="social-buttons2" style="height:50px;">
                                    @include('auth.social')
                                </div>

                            </div>
                            <div class="clear"></div>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Запомнить пароль
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Вход
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                        Забыли пароль?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(Request::path() != 'login_admin')
                        <div class="panel-heading" style="border-top: 1px solid #cccccc">
                            Впервые здесь ? <a style="float: right" href="{{ url('/register') }}"><b>Регистрация</b></a>
                            <div style="clear: both"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
