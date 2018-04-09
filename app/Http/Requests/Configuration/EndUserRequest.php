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
        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email'.(isset($this->edit) && $this->edit == '1' ? ','.base64_decode($this->end_user_id) : '' )
        ];
        
        if($this->super_admin_flag == '1') {
            $rules['admin_users']   =  'required';
        }

        return $rules;
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
            'admin_users.required'          =>  trans('messages.errors.configuration.end_user.admin_users_required')
        ];
    }
}
