<?php
namespace App;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
class CustomValidator extends Validator {

    public function validateOldpassword($attribute, $value, $parameters)
    {
    //$atribute - это название поля, в нашем случае site
    //$value - значение поля
    //$parameters - это параметры, которые можно передать так urlrl:ru, ($parameters=['ru'
        return Hash::check($value, Auth::user()->password);
    }
}