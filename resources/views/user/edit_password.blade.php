@extends('user.app')
@section('profile')
    <div class="rcol-sm-6 col-md-9 col-lg-9">
        <h4>Изменение пароля</h4>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/password') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Старый пароль</label>

                <div class="col-md-6">
                    <input id="old_password" type="password" class="form-control" name="old_password" value="" required autofocus>

                    @if ($errors->has('old_password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Новый пароль</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('confirmPassword') ? ' has-error' : '' }}">
                <label for="confirmPassword" class="col-md-4 control-label">Пароль повторно</label>

                <div class="col-md-6">
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('confirmPassword') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Сохранить
                    </button>
                </div>
            </div>
        </form>
</div>
@endsection