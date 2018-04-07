<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Subscription as CashierSubscription;

class StripeSubscription extends CashierSubscription
{
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
        return $this->belongsTo('StripeSubscriptionPlan', 'plan_id');
    }
}
