<?php

namespace App\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class EndUserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email'.(isset($this->edit) && $this->edit == '1' ? ','.$this->end_user_id : '' ),
            'password'          => 'required',
            'confirm_password'   => 'required|same:password'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'                 =>  trans('messages.errors.configuration.end_user.name_required'),
            'email.required'                =>  trans('messages.errors.configuration.end_user.email_required'),
            'email.email'                   =>  trans('messages.errors.configuration.end_user.email_email'),
            'email.unique'                  =>  trans('messages.errors.configuration.end_user.email_unique'),
            'password.required'               =>  trans('messages.errors.configuration.end_user.password_required'),
            'confirmPassword.required'        =>  trans('messages.errors.configuration.end_user.confirm_password_required'),
            'confirmPassword.same'          =>  trans('messages.errors.configuration.end_user.confirm_password_same'),

        ];
    }
}
