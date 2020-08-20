@extends('user.app')
@section('profile')
        <div class="rcol-sm-6 col-md-9 col-lg-9">
        <h4>Редактирование профиля</h4>
        <p>поля отмеченные звездочкой<span class="red">*</span> обязательны для заполнения</p>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/edit') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Тип пользователя<span class="red">*</span></label>

                    <div class="col-md-8 form-inline">
                        @if($user->profile && $user->profile->type_client_id)
                            <input type="radio" class="form-control type_user"  @if($user->profile->type_client_id == 1) checked @endif disabled> частное лицо
                            <input type="radio" class="form-control type_company"  @if($user->profile->type_client_id == 2) checked @endif disabled> организация
                            <input type="hidden" name="type_client" value="{{ $user->profile->type_client_id }}">
                        @else
                            <input type="radio" id="client_user" class="form-control type_user" name="type_client" value="1"  @if((old() && old('type_client') == 1) || !old()) checked @endif> частное лицо
                            <input type="radio" id="client_company" class="form-control type_company" name="type_client" value="2" @if(old() && old('type_client') == 2) checked @endif> организация
                        @endif

                    </div>
                </div>
                <div class="form-group{{ $errors->has('client_name') ? ' has-error' : '' }}">
                    <label id="name_account" for="phone" class="col-md-3 control-label">@if($user->is_company(old('type_client'))) Компания @else ФИО @endif<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input id="phone" type="text" class="form-control" name="client_name" value="@if(old()){{ old('client_name') }}@else{{ $user->profile->client_name or '' }}@endif" @if(isset($user->profile->client_name)) readonly @endif placeholder="@if(!old() && $user->is_company(old('type_client'))) Краткое наименование организации @else  Фамилия Имя Отчество @endif">

                        @if ($errors->has('client_name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('client_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group client_company{{ $errors->has('user_company') ? ' has-error' : '' }}" @if($user->is_person(old('type_client'))) style="display: none" @endif>
                    <label for="phone" class="col-md-3 control-label">Имя</label>

                    <div class="col-md-9">
                        <input id="phone" type="text" class="form-control" name="user_company" value="@if(old()){{ old('user_company') }}@else{{ $user->profile->user_company or '' }}@endif" placeholder="Фамилия Имя Отчество контактного лица компании.">

                        @if ($errors->has('user_company'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('user_company') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="skype" class="col-md-3 control-label">E-mail<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input id="skype" type="text" class="form-control" name="email" value="{{ $user->email or '' }}" @if(isset($user->email)) readonly @endif>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-3 control-label">телефон<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input id="phone" type="text" class="form-control" name="phone" value="@if(old()){{ old('phone') }}@else{{ $user->profile->phone or '' }}@endif" @if($user->is_person() && isset($user->profile->phone)) readonly @endif placeholder="номер мобильного телефона(050xxxxxxx)">

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-md-3 control-label">Адрес доставки</label>
                    <div class="col-md-9">
                        <div class="col-md-6" style=" padding:5px">
                            <input  type="text" class="form-control" name="delivery_town" value="@if(old()){{ old('delivery_town') }}@else{{ $user->profile->delivery_town or '' }}@endif" >
                        </div>
                        <label  class="control-label">город, населенный пункт</label>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <div class="col-md-6" style=" padding:5px">
                            <input  type="text" class="form-control" name="delivery_street" value="@if(old()){{ old('delivery_street') }}@else{{ $user->profile->delivery_street or '' }}@endif" >
                            <label  class="control-label">улица</label>
                        </div>
                        <div class="col-md-2" style=" padding: 5px">
                            <input  type="text" class="form-control" name="delivery_house" value="@if(old()){{ old('delivery_house') }}@else{{ $user->profile->delivery_house or '' }}@endif" >
                            <label  class="control-label">дом</label>
                        </div>
                        <div class="col-md-2" style=" padding: 5px">
                            <input  type="text" class="form-no-control" name="delivery_house_block" value="@if(old()){{ old('delivery_house_block') }}@else{{ $user->profile->delivery_house_block or '' }}@endif">
                            <label>корпус</label>
                        </div>
                        <div class="col-md-2" style=" padding: 5px">
                            <input  type="text" class="form-no-control" name="delivery_office" value="@if(old()){{ old('delivery_office') }}@else{{ $user->profile->delivery_office or '' }}@endif">
                            <label>квартира</label>
                        </div>
                    </div>
                </div>
                <div class="client_company" @if($user->is_person(old('type_client'))) style="display: none" @endif>
                    <div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-3 control-label">Предпочтительная форма оплаты<span class="red">*</span></label>

                        <div class="col-md-9 form-inline">
                            <input type="radio" id="payment_nal" class="form-control" name="type_payment" value="1" @if($user->is_payment_nal(old('type_payment'))) checked @endif> наличный расчет
                            <input type="radio" id="payment_b_nal" class="form-control" name="type_payment" value="2" @if($user->is_payment_b_nal(old('type_payment'))) checked @endif> безналичный расчет
                            <input type="radio" id="payment_nds" class="form-control" name="type_payment" value="3" @if($user->is_payment_nds(old('type_payment'))) checked @endif> безналичный с НДС
                            <p class="order_info">Для безналичного расчета укажите, пожалуйста, реквизиты организации в расширенной форме заказа.
                                Обращаем Ваше внимание, что формирование счёта за услуги возможно только при наличии документов, подтверждающих государственную
                                регистрацию компании. После заполнения всех реквизитов редактирование будет доступно только через администратора на сайте или по
                                телефону офиса, который Вас обслуживает.”
                            </p>
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('company_full') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="phone" class="col-md-3 control-label">Компания<span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="phone" type="text" class="form-control" name="company_full" value="@if(old()){{ old('company_full') }}@else{{ $user->profile->company_full or '' }}@endif" @if(isset($user->profile->company_full)) readonly @endif placeholder="Полное наименование организации (согласно выписке из госреестра)">
                            @if ($errors->has('company_full'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('company_full') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('edrpou') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="icq" class="col-md-3 control-label">Код ЕГРПОУ<span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="icq" type="text" class="form-control" name="edrpou" value="@if(old()){{ old('edrpou') }}@else{{ $user->profile->edrpou or '' }}@endif" @if(isset($user->profile->edrpou)) readonly @endif placeholder="Должен содержать 8 - 10 знаков">

                            @if ($errors->has('edrpou'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('edrpou') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_nds{{ $errors->has('inn') ? ' has-error' : '' }}" @if(!$user->is_payment_nds(old('type_payment'))) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">ИНН<span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="inn" value="@if(old()){{ old('inn') }}@else{{ $user->profile->inn or '' }}@endif" @if(isset($user->profile->inn)) readonly @endif placeholder="Индивидуальный налоговый номер, должен содержать 10 знаков">

                            @if ($errors->has('inn'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('inn') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('code_index') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Индекс<span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="code_index" value="@if(old()){{ old('code_index') }}@else{{ $user->profile->code_index or '' }}@endif" @if(isset($user->profile->code_index)) readonly @endif placeholder="Почтовый индекс, должен содержать 5 знаков">

                            @if ($errors->has('code_index'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('code_index') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('region') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Регион</label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="region" value="@if(old()){{ old('region') }}@else{{ $user->profile->region or '' }}@endif" @if(isset($user->profile->region)) readonly @endif>

                            @if ($errors->has('region'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('area') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Район</label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="area" value="@if(old()){{ old('area') }}@else{{ $user->profile->area or '' }}@endif" @if(isset($user->profile->area)) readonly @endif>

                            @if ($errors->has('area'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('city') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Город<span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="city" value="@if(old()){{ old('city') }}@else{{ $user->profile->city or '' }}@endif" @if(isset($user->profile->city)) readonly @endif>

                            @if ($errors->has('city'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('street') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Улица<span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="street" value="@if(old()){{ old('street') }}@else{{ $user->profile->street or '' }}@endif" @if(isset($user->profile->street)) readonly @endif>

                            @if ($errors->has('street'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('house') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Дом<span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="house" value="@if(old()){{ old('house') }}@else{{ $user->profile->house or '' }}@endif" @if(isset($user->profile->house)) readonly @endif>

                            @if ($errors->has('house'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('house') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('house_block') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Корпус</label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="house_block" value="@if(old()){{ old('house_block') }}@else{{ $user->profile->house_block or '' }}@endif" @if(isset($user->profile->house_block)) readonly @endif>

                            @if ($errors->has('house_block'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('house_block') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group payment_b_nal{{ $errors->has('office') ? ' has-error' : '' }}" @if($user->is_payment_nal(old('type_payment'))) style="display: none" @endif>
                        <label for="address" class="col-md-3 control-label">Квартира/офис</label>

                        <div class="col-md-9">
                            <input id="address" type="text" class="form-control" name="office" value="@if(old()){{ old('office') }}@else{{ $user->profile->office or '' }}@endif" @if(isset($user->profile->office)) readonly @endif>

                            @if ($errors->has('office'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('office') }}</strong>
                                    </span>
                            @endif
                        </div>
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