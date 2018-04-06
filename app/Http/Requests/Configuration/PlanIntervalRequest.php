<?php

namespace App\Http\Requests\Configuration;

use Illuminate\Foundation\Http\FormRequest;

class PlanIntervalRequest extends FormRequest
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
            'interval_name'     =>  'required',
            'interval'          =>  'required',
            'interval_count'    =>  'required'
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
            'interval_name.required'              =>  trans('messages.errors.configuration.intervals.interval_name_required'),
            'interval.required'                   =>  trans('messages.errors.configuration.intervals.interval_required'),
            'interval_count.required'             =>  trans('messages.errors.configuration.intervals.interval_count_required'),
        ];
    }
}
