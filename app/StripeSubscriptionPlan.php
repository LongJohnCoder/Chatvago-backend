<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StripeSubscriptionPlan extends Model
{
    use SoftDeletes;
}
