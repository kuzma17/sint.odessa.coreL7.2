<?php
/**
 * Created by PhpStorm.
 * User: kuzma
 * Date: 31.03.17
 * Time: 10:54
 */

$user = Auth::user();
$type_order = \App\TypeOrder::all();
?>

<div id="orderModal" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content modal-order">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">Оформить заказ</h4>
            </div>

            <form name="order" method="post" class="form-horizontal" action="{{ url('/order') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-3 control-label">Тип услуги<span class="red">*</span></label>
                    <div class="col-md-9">
                        <select name="type_order" class="form-control" autofocus>
                            @foreach($type_order as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Тип пользователя<span class="red">*</span></label>

                    <div class="col-md-8 form-inline">
                        @if(isset($user->profile) && $user->profile->type_client_id)
                            <input type="radio" class="form-control type_user"  @if($user->profile->type_client_id == 1) checked @endif disabled> частное лицо
                            <input type="radio" class="form-control type_company"  @if($user->profile->type_client_id == 2) checked @endif disabled> организация
                            <input type="hidden" name="order_type_client" value="{{ $user->profile->type_client_id }}">
                        @else
                            <input type="radio" class="form-control type_user" name="order_type_client" value="1" checked > частное лицо
                            <input type="radio" class="form-control type_company" name="order_type_client" value="2" > организация
                        @endif
</div>
</div>
<div class="form-group{{ $errors->has('order_name') ? ' has-error' : '' }}">
<label class="col-md-3 control-label name_account">@if((isset($user->profile) && $user->profile->type_client_id == 2 )) Компания @else ФИО @endif<span class="red">*</span></label>

<div class="col-md-9">
<input type="text" class="form-control" name="order_client_name" value="@if(isset($user->profile)){{ $user->profile->client_name}}@endif" @if(isset($user->profile->client_name)) readonly @endif placeholder="@if(!old() && isset($order) && $order->order_type_client == 2) Краткое наименование организации @else Фамилия Имя Отчество @endif" required autofocus>

@if ($errors->has('order_name'))
    <span class="help-block">
                <strong>{{ $errors->first('order_name') }}</strong>
            </span>
@endif
</div>
</div>
<div class="form-group client_company_order{{ $errors->has('order_user_company') ? ' has-error' : '' }}" @if((isset($user->profile) && $user->profile->type_client_id == 1 ) || !isset($user->profile)) style="display: none" @endif>
<label for="phone" class="col-md-3 control-label">Контактное лицо</label>

<div class="col-md-9">
<input type="text" class="form-control" name="order_user_company" value="@if(isset($user->profile)){{ $user->profile->user_company}}@endif" placeholder="Фамилия Имя Отчество контактного лица компании.">

@if ($errors->has('order_user_company'))
    <span class="help-block">
                <strong>{{ $errors->first('order_user_company') }}</strong>
            </span>
@endif
</div>
</div>
<div class="form-group{{ $errors->has('order_email') ? ' has-error' : '' }}">
<label class="col-md-3 control-label">E-mail<span class="red">*</span></label>

<div class="col-md-9">
<input type="text" class="form-control" name="order_email" value="@if(isset($user->email)){{ $user->email}}@endif" @if(isset($user->email)) readonly @endif required>

@if ($errors->has('order_email'))
    <span class="help-block">
                <strong>{{ $errors->first('order_email') }}</strong>
            </span>
@endif
</div>
</div>
<div class="form-group{{ $errors->has('order_phone') ? ' has-error' : '' }}">
<label class="col-md-3 control-label">телефон<span class="red">*</span></label>

<div class="col-md-9">
<input type="text" class="form-control" name="order_phone" value="@if(isset($user->profile)){{ $user->profile->phone}}@endif" @if((isset($user->profile) && $user->profile->type_client_id== 1) && isset($user->profile->phone)) readonly @endif placeholder="номер мобильного телефона (050xxxxxxx)" required>

@if ($errors->has('order_phone'))
    <span class="help-block">
                <strong>{{ $errors->first('order_phone') }}</strong>
            </span>
@endif
</div>
</div>
<div class="form-group{{ $errors->has('order_address') ? ' has-error' : '' }}">
<label  class="col-md-3 control-label">Адрес доставки<span class="red">*</span></label>

<div class="col-md-9">
    <div class="col-md-6" style=" padding:5px">
        <input  type="text" class="form-control" name="order_delivery_town" value="@if(isset($user->profile)){{$user->profile->delivery_town}}@endif" required placeholder="город, населенный пункт">
    </div>
    <label  class="control-label label1">город, населенный пункт<span class="red">*</span></label>
</div>
    <div class="col-md-3"></div>
    <div class="col-md-9">
    <div class="col-md-6" style=" padding:5px">
    <input  type="text" class="form-control" name="order_delivery_street" value="@if(isset($user->profile)){{$user->profile->delivery_street}}@endif" required placeholder="улица">
        <label  class="control-label label1">улица<span class="red">*</span></label>
    </div>
    <div class="col-md-2" style=" padding: 5px">
    <input  type="text" class="form-control" name="order_delivery_house" value="@if(isset($user->profile)){{$user->profile->delivery_house}}@endif" required placeholder="номер">
        <label  class="control-label label1">дом<span class="red">*</span></label>
    </div>
    <div class="col-md-2" style=" padding: 5px">
        <input  type="text" class="form-control" name="order_delivery_house_block" value="@if(isset($user->profile)){{$user->profile->delivery_house_block}}@endif" placeholder="корпус">
        <label  class="label1">корпус</label>
    </div>
    <div class="col-md-2" style=" padding: 5px">
        <input  type="text" class="form-control" name="order_delivery_office" value="@if(isset($user->profile)){{$user->profile->delivery_office}}@endif" placeholder="квартира">
        <label  class="label1">квартира</label>
    </div>

@if ($errors->has('order_address'))
    <span class="help-block">
                <strong>{{ $errors->first('order_address') }}</strong>
            </span>
@endif
</div>
</div>
<div class="client_company_order" @if((isset($user->profile) && $user->profile->type_client_id== 1) || !isset($user->profile)) style="display: none" @endif>
<div class="form-group{{ $errors->has('fio') ? ' has-error' : '' }}">
<label class="col-md-3 control-label">Форма оплаты<span class="red">*</span></label>

<div class="col-md-9 form-inline">
    <input type="radio" id="payment_nal" class="form-control" name="order_type_payment" value="1" @if((isset($user->profile) && $user->profile->type_payment_id == 1) || !isset($user->profile)) checked @endif> наличный расчет
    <input type="radio" id="payment_b_nal" class="form-control" name="order_type_payment" value="2" @if(isset($user->profile) && $user->profile->type_payment_id == 2) checked @endif> безналичный расчет
    <input type="radio" id="payment_nds" class="form-control" name="order_type_payment" value="3" @if(isset($user->profile) && $user->profile->type_payment_id == 3) checked @endif> безналичный с НДС
</div>
<p class="order_info" >Для безналичного расчета укажите, пожалуйста, реквизиты организации в расширенной форме заказа. Обращаем Ваше внимание,
    что формирование счёта за услуги возможно только при наличии документов, подтверждающих государственную регистрацию компании.
    После заполнения всех реквизитов редактирование будет доступно только через администратора на сайте или по телефону офиса, который Вас обслуживает.
</p>
</div>
</div>
<div class="form-group{{ $errors->has('order_comment') ? ' has-error' : '' }}">
<label class="col-md-3 control-label">Комментарий</label>

<div class="col-md-9">
<textarea class="form-control" name="order_comment" placeholder="Например, укажите количество картриджей или описание неисправности техники"></textarea>

@if ($errors->has('order_comment'))
    <span class="help-block">
                <strong>{{ $errors->first('order_comment') }}</strong>
            </span>
@endif
</div>
</div>
<div class="form-group">
<div class="col-md-8 col-md-offset-4">
<input type="submit" name="add_order" class="btn btn-primary" value="Сохранить">
<input id="all_order" type="submit" name="all_order" class="btn btn-default" value="Расширенный заказ"  @if(isset($user->profile) && $user->profile->type_client_id== 1 || !isset($user->profile)) style="display: none" @endif>
</div>
</div>
</form>
</div>
</div>
</div>
