<?php

namespace App\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
            'name'  => 'required',
            'email' =>  'required|email|unique:users,email,'.base64_decode($this->admin_id)
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
            'name.required'       =>  trans('messages.errors.configuration.admin.name_required'),
            'email.required'      =>  trans('messages.errors.configuration.admin.email_required'),
            'email.email'         =>  trans('messages.errors.configuration.admin.email_email'),
            'email,unique'        =>  trans('messages.errors.configuration.admin.email_unique'),
        ];
    }
}
