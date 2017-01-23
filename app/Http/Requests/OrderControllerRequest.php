<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderControllerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'contact_name.required' => 'Контактное имя - обязательный реквизит',
            'contact_name.regex' => 'Контактное имя должно состоять только из букв',
            'e_mail.email'=>'Некорректный почтовый адресс',
            'e_mail.min'=>'Короткий почтовый адресс',
            'phone.regex'=>'Некорректные символы в телефонном номере',
            'phone.min'=>'Короткий телефонный номер',
            'payer'=>'Недопустимые символы в названии плательщика',
            'description'=>'Недопустимые символы в комментарии',
            'phone.required_without'=>'Необходим или телефон или почтовый адрес',
            'e_mail.required_without'=>'Необходим или телефон или почтовый адрес',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contact_name'=>'required|regex:/^[a-zA-Zа-яА-Я ]+$/u',
            'phone'=>'required_without:e_mail|min:9|regex:/^[\d +()-]+$/u',
            'e_mail'=>'required_without:phone|email|min:9',
            'payer'=>'regex:{[\s\S]+}u',
            'description'=>'regex:{[\s\S]+}u',
        ];
    }
}
