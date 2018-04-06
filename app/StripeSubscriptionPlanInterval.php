<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StripeSubscriptionPlanInterval extends Model
{
    use SoftDeletes;
}
