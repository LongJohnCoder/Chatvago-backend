<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StripeSubscriptionPlan extends Model
{
    use SoftDeletes;

    /**
     * Each stripe subscription plan has one interval.
     */
    public function interval(){
        return $this->hasOne('App\StripeSubscriptionPlanInterval','id','plan_interval');
    }
}
