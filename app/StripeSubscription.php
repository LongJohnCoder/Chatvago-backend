<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeSubscription extends Model
{
    protected $table = 'subscriptions';
	 /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stripe_subscription_plan()
    {
        return $this->belongsTo('App\StripeSubscriptionPlan', 'plan_id');
    }
}
