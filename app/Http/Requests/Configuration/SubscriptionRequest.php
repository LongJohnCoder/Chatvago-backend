<?php

namespace App\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'plan_name'         =>  'required',
            'plan_id'           =>  'required',
            'plan_price'        =>  'required|numeric',
            'plan_interval'     =>  'required',
            'profile_creation'  =>  'required|integer',
            'pages_per_user'    =>  'required|integer'
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
            'plan_name.required'                 =>  trans('messages.errors.configuration.subscription.plan_name_required'),
            'plan_id.required'                   =>  trans('messages.errors.configuration.subscription.plan_id_required'),
            'plan_price.required'                =>  trans('messages.errors.configuration.subscription.plan_price_required'),
            'plan_price.numeric'                 =>  trans('messages.errors.configuration.subscription.plan_price_numeric'),
            'plan_interval.required'             =>  trans('messages.errors.configuration.subscription.plan_interval_required'),
            'profile_creation.required'          =>  trans('messages.errors.configuration.subscription.profile_creation_required'),
            'profile_creation.integer'           =>  trans('messages.errors.configuration.subscription.profile_creation_integer'),
            'pages_per_user.required'            =>  trans('messages.errors.configuration.subscription.pages_per_user_required'),
            'pages_per_user.integer'             =>  trans('messages.errors.configuration.subscription.pages_per_user_integer'),
        ];
    }
}
