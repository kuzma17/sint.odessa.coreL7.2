<div class="container">
    <div class="row">
    <div class="rcol-sm-12 col-md-12 col-lg-12">Добро пожаловать
        <ul class="top-menu">
            <li><a title="{{ config('app.name', 'Laravel') }}" href="http://sint.odessa.ua"
                   onclick="window.external.AddFavorite('http://sint.odessa.ua',
                           '{{ config('app.name', 'Laravel') }}'); return false;" rel="sidebar"><i class="glyphicon glyphicon-heart"></i> В избранное</a></li>
            <li><a href="{{ url('/mail') }}"><i class="glyphicon glyphicon-envelope"></i> Написать нам</a></li>
            <!--<li><a href="{{ url('/info') }}"><i class="fa fa-info-circle"></i> Как сделать заказ</a></li>-->
            <li><a href="{{ url('/delivery') }}"><i class="fa fa-truck" aria-hidden="true"></i> Доставка</a></li>
           <!-- @if (Auth::guest())
                <li class="dropdown noclose">
                    <a id="drop1" href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i> Вход</a>

                    <ul id="login-dp" class="dropdown-menu dropdown-menu-right">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    Авторизация через соцсети
                                    <div class="social-buttons">
					                    <a href="{{ url('/social/facebook') }}" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a>
                                        <a href="{{ url('/social/twitter') }}" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a>-->
                                        <!-- <a href="{{ url('/social/odnoklassniki') }}" class="btn btn-od"><i class="fa fa-odnoklassniki"></i> Odniklassniki</a>
                                        <a href="{{ url('/social/vkontakte') }}" class="btn btn-vk"><i class="fa fa-vk"></i> Vkontakte</a>
                                        <a href="{{ url('/social/mailru') }}" class="btn btn-mr"><i class="fa fa-at"></i> Mail.ru</a> -->
                                        <!--<a href="{{ url('/social/google') }}" class="btn btn-go"><i class="fa fa-google"></i> Google</a>
                                        <a href="{{ url('/social/github') }}" class="btn btn-git"><i class="fa fa-github" aria-hidden="true"></i> Github</a>
                                    </div>
                                    или
                                    <form class="form" role="form" method="post" action="{{ url('/login') }}" accept-charset="UTF-8" id="login-nav">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="sr-only" for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="help-block error_login_message">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="password">Пароль</label>
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Пароль" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block error_login_message">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                            <div class="help-block text-right"><a href="{{ url('/password/reset') }}">Забыли пароль?</a></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block">Вход</button>
                                        </div>-->
                                        <!-- <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Запомнить пароль
                                            </label>
                                        </div> -->
                                   <!-- </form>
                                </div>
                                <div class="bottom text-center">-->
                                    <!--Впервые здесь ? <a href="{{ url('/register') }}"><b>Регистрация</b></a>-->
                                    <!--<a href="{{ url('/register') }}" class="btn btn-od" style=""><i class="fa fa-at"></i> <b>Регистрация</b></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            @else
                <li class="dropdown">
                    <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i> {{ Auth::user()->name }}</a>

                    <ul id="login-dp" class="dropdown-menu dropdown-menu-right">
                        <li><div class="row">
                                <div class="col-md-12"><a href="{{ url('/user/') }}">Личный кабинет</a></div></div></li>
                        <li><div class="row">
                                <div class="col-md-12"><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> Выход
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    <br>
                                </div></div>
                        </li>
                    </ul>
                </li>
            @endif -->
        </ul>
    </div>
    </div>
</div>
