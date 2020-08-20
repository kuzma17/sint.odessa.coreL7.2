@extends('user.app')
@section('profile')
        <div class="rcol-sm-6 col-md-9 col-lg-9">
        <h4>Редактирование фото</h4>


                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/user/avatar') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                <label for="avatar" class="col-md-4 control-label">Выберите картинку</label>

                                <div class="col-md-6" >
                                        <div class="avatar-upload" data-text="Выберите файл">
                                        <input id="avatar" type="file" name="avatar" value="" required autofocus >
                                        </div>
                                        @if ($errors->has('avatar'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
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