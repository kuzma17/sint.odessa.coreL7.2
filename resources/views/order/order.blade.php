@extends('layouts.container3')

@section('content')
    <div class="content-page">
        <h3>Оформление заказа</h3>
        <form name="order_order" method="post" class="form-horizontal" action="{{ url('/order') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label  class="col-md-3 control-label">Тип услуги<span class="red">*</span></label>

                <div class="col-md-9">
                    <select name="type_order" class="form-control">
                        @foreach($type_order as $type)
                            <option value="{{ $type->id }}" @if((old() && $type->id == old('type_order')) || (!old() && isset($order) && $type->id == $order->type_order)) selected="selected" @endif>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>



            <div class="form-group{{ $errors->has('order_fio') ? ' has-error' : '' }}">
                <label  class="col-md-4 control-label">Тип пользователя<span class="red">*</span></label>

                <div class="col-md-8 form-inline">

                    @if($user->profile && $user->profile->type_client_id)
                        <input type="radio" class="form-control type_user"  @if($user->profile->type_client_id == 1) checked @endif disabled> частное лицо
                        <input type="radio" class="form-control type_company"  @if($user->profile->type_client_id == 2) checked @endif disabled> организация
                        <input type="hidden" name="order_type_client" value="{{ $user->profile->type_client_id }}">
                    @elseif(!isset($user->profile->order_type_client) && isset($order))
                        <input type="radio" class="form-control type_user" name="order_type_client" value="1"  @if($order->order_type_client == 1) checked @endif> частное лицо
                        <input type="radio" class="form-control type_company" name="order_type_client" value="2" @if($order->order_type_client == 2) checked @endif> организация
                    @else
                        <input type="radio" class="form-control type_user" name="order_type_client" value="1"  @if((old() && old('order_type_client') == 1) || !old()) checked @endif> частное лицо
                        <input type="radio" class="form-control type_company" name="order_type_client" value="2" @if(old() && old('order_type_client') == 2) checked @endif> организация
                    @endif

                </div>
            </div>
            <div class="form-group{{ $errors->has('order_client_name') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label name_account">@if((old() && old('order_type_client') == 2) || (!old() && isset($order) && $order->order_type_client == 2)) Компания @else ФИО @endif<span class="red">*</span></label>

                <div class="col-md-9">
                    <input placeholder="Фамилия Имя Отчество" type="text" class="form-control" name="order_client_name" value="@if(old()){{ old('order_client_name') }}@else{{ $order->order_client_name or ''}}@endif" @if(isset($user->profile->client_name)) readonly @endif autofocus>

                    @if ($errors->has('order_client_name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_client_name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group client_company_order{{ $errors->has('order_user_company') ? ' has-error' : '' }}" @if((old() && old('order_type_client') == 1) || (!old() && isset($order) && $order->order_type_client == 1 )) style="display: none" @endif>
                <label  class="col-md-3 control-label">Контактное лицо</label>

                <div class="col-md-9">
                    <input placeholder="Фамилия Имя Отчество контактного лица компании." id="user_company" type="text" class="form-control" name="order_user_company" value="@if(old()){{ old('order_user_company') }}@else{{ $order->order_user_company or '' }}@endif" >


                    @if ($errors->has('order_user_company'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_user_company') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('order_email') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">E-mail<span class="red">*</span></label>

                <div class="col-md-9">
                    <input id="skype" type="text" class="form-control" name="order_email" value="{{ $user->email or '' }}" @if(isset($user->email)) readonly @endif >

                    @if ($errors->has('order_email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('order_phone') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">телефон<span class="red">*</span></label>

                <div class="col-md-9">
                    <input  type="text" class="form-control" name="order_phone" value="@if(old()){{ old('order_phone') }}@else{{ $order->order_phone or '' }}@endif" @if($user->is_person() && isset($user->profile->phone)) readonly @endif placeholder="номер мобильного телефона (050xxxxxxx)">

                    @if ($errors->has('order_phone'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_phone') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('order_delivery_town') || $errors->has('order_delivery_street') || $errors->has('order_delivery_house') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">Адрес доставки<span class="red">*</span></label>
                <div class="col-md-9">
                    <div class="col-md-6" style=" padding:5px">
                        <input type="text" class="form-control" name="order_delivery_town" value="@if(old()){{ old('order_delivery_town') }}@else{{ $order->order_delivery_town or '' }}@endif" placeholder="город, населенный пункт">
                    </div>
                        <label  class="control-label label1">город, населенный пункт<span class="red">*</span></label>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <div class="col-md-6" style=" padding:5px">
                        <input type="text" class="form-control" name="order_delivery_street" value="@if(old()){{ old('order_delivery_street') }}@else{{ $order->order_delivery_street or '' }}@endif" placeholder="улица">
                        <label class="control-label label1">улица<span class="red">*</span></label>
                    </div>
                    <div class="col-md-2" style=" padding: 5px">
                        <input type="text" class="form-control" name="order_delivery_house" value="@if(old()){{ old('order_delivery_house') }}@else{{ $order->order_delivery_house or '' }}@endif" placeholder="номер">
                        <label class="control-label label1">дом<span class="red">*</span></label>
                    </div>
                    <div class="col-md-2" style=" padding: 5px">
                        <input type="text" class="form-no-control" name="order_delivery_house_block" value="@if(old()){{ old('order_delivery_house_block') }}@else{{ $order->order_delivery_house_block or '' }}@endif" placeholder="корпус">
                        <label class="label1">корпус</label>
                    </div>
                    <div class="col-md-2" style=" padding: 5px">
                        <input type="text" class="form-no-control" name="order_delivery_office" value="@if(old()){{ old('order_delivery_office') }}@else{{ $order->order_delivery_office or '' }}@endif" placeholder="квартира">
                        <label class="label1">квартира</label>
                    </div>
                    @if ($errors->has('order_delivery_town') || $errors->has('order_delivery_street') || $errors->has('order_delivery_house'))
                       <div class="clear"></div>
                        <span class="help-block">
                <strong>Поля обязательные для заполнения.</strong>
            </span>
                    @endif
                </div>
            </div>
            <div class="client_company_order" @if((old() && old('order_type_client') == 1) || (!old() && isset($order) && $order->order_type_client == 1))  style="display: none" @endif>
                <div class="form-group{{ $errors->has('order_fio') ? ' has-error' : '' }}">
                    <label  class="col-md-3 control-label">Форма оплаты<span class="red">*</span></label>

                    <div class="col-md-9 form-inline">
                        <input type="radio" id="payment_nal" class="form-control" name="order_type_payment" value="1" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) checked @endif> наличный расчет
                        <input type="radio" id="payment_b_nal" class="form-control" name="order_type_payment" value="2" @if((old() && old('order_type_payment') == 2) || (!old() && isset($order) && $order->order_type_payment == 2)) checked @endif> безналичный расчет
                        <input type="radio" id="payment_nds" class="form-control" name="order_type_payment" value="3" @if((old() && old('order_type_payment') == 3) || (!old() && isset($order) && $order->order_type_payment == 3)) checked @endif> безналичный с НДС
                        <p class="order_info">Для безналичного расчета укажите, пожалуйста, реквизиты организации в расширенной форме заказа. Обращаем Ваше внимание, что формирование счёта за услуги возможно только при наличии документов, подтверждающих государственную регистрацию компании.
                            После заполнения всех реквизитов редактирование будет доступно только через администратора на сайте или по телефону офиса, который Вас обслуживает.
                        </p>
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_company_full') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Компания<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input placeholder="Полное наименование (согласно выписке из государственного реестра)" type="text" class="form-control" name="order_company_full" value="@if(old()){{ old('order_company_full') }}@else{{ $user->profile->company_full or '' }}@endif" @if(isset($user->profile->company_full)) readonly @endif>

                        @if ($errors->has('order_company_full'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_company_full') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_edrpou') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label class="col-md-3 control-label">Код ЕГРПОУ<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input placeholder="Должен содержать 8 - 10 знаков" type="text" class="form-control" name="order_edrpou" value="@if(old()){{ old('order_edrpou') }}@else{{ $user->profile->edrpou or '' }}@endif" @if(isset($user->profile->edrpou)) readonly @endif>


                        @if ($errors->has('order_edrpou'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_edrpou') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_nds{{ $errors->has('order_inn') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') != 3) || (!old() && isset($order) && $order->order_type_payment !=3)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">ИНН<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input placeholder="Индивидуальный налоговый номер, должен содержать 10 знаков" type="text" class="form-control" name="order_inn" value="@if(old()){{ old('order_inn') }}@else{{ $user->profile->inn or '' }}@endif" @if(isset($user->profile->inn)) readonly @endif>


                        @if ($errors->has('order_inn'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_inn') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_code_index') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Индекс<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_code_index" value="@if(old()){{ old('order_code_index') }}@else{{ $user->profile->code_index or '' }}@endif" @if(isset($user->profile->code_index)) readonly @endif placeholder="Почтовый индекс, должен содержать 5 знаков">


                        @if ($errors->has('order_code_index'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_code_index') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_region') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Регион</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_region" value="@if(old()){{ old('order_region') }}@else{{ $user->profile->region or '' }}@endif" @if(isset($user->profile->region)) readonly @endif>

                        @if ($errors->has('order_region'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_region') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_area') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Район</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_area" value="@if(old()){{ old('order_area') }}@else{{ $user->profile->area or '' }}@endif" @if(isset($user->profile->area)) readonly @endif>

                        @if ($errors->has('order_area'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_area') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_city') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Город<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_city" value="@if(old()){{ old('order_city') }}@else{{ $user->profile->city or '' }}@endif" @if(isset($user->profile->city)) readonly @endif>

                        @if ($errors->has('order_city'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_city') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_street') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Улица<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_street" value="@if(old()){{ old('order_street') }}@else{{ $user->profile->street or '' }}@endif" @if(isset($user->profile->street)) readonly @endif>

                        @if ($errors->has('order_street'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_street') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_house') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Дом<span class="red">*</span></label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_house" value="@if(old()){{ old('order_house') }}@else{{ $user->profile->house or '' }}@endif" @if(isset($user->profile->house)) readonly @endif>

                        @if ($errors->has('order_house'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_house') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_house_block') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Корпус</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_house_block" value="@if(old()){{ old('order_house_block') }}@else{{ $user->profile->house_block or '' }}@endif" @if(isset($user->profile->house_block)) readonly @endif>

                        @if ($errors->has('order_house_block'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_house_block') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group payment_b_nal{{ $errors->has('order_office') ? ' has-error' : '' }}" @if((old() && old('order_type_payment') == 1) || (!old() && isset($order) && $order->order_type_payment == 1)) style="display: none" @endif>
                    <label  class="col-md-3 control-label">Квартира/офис</label>

                    <div class="col-md-9">
                        <input  type="text" class="form-control" name="order_office" value="@if(old()){{ old('order_office') }}@else{{ $user->profile->office or '' }}@endif" @if(isset($user->profile->office)) readonly @endif>

                        @if ($errors->has('order_office'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order_office') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('order_comment') ? ' has-error' : '' }}">
                <label  class="col-md-3 control-label">Комментарий</label>

                <div class="col-md-9">
                    <textarea class="form-control" name="order_comment" placeholder="Например, укажите количество картриджей или описание неисправности техники).">@if(old()){{ old('order_comment') }}@else{{ $order->order_comment or ''}}@endif</textarea>

                    @if ($errors->has('order_comment'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('order_comment') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <input type="submit" class="btn btn-primary" name="add_all_order" value="Сохранить">
                </div>
            </div>
        </form>

    </div>
@endsection