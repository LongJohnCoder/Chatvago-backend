<?php

namespace App;

use Laravel\Spark\User as SparkUser;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends SparkUser
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'two_factor_reset_code',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'uses_two_factor_auth' => 'boolean',
    ];

    /**
     * Lists all admin users
     * @param $query
     * @return mixed
     */
    public function scopeAdmin($query) {
        return $query->where('role','=','2');
    }

    /**
     * Lists all end users
     * @param $query
     * @return mixed
     */
    public function scopeEndUsers($query) {
        return $query->where('role','=','3');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function check_end_users() {
        return $this->hasMany('App\User','admin_id');
    }

    /**
     * Returns the end users of an admin.
     * @return mixed
     */
    public function end_users() {
        return $this->check_end_users()->where('role','=','3');
    }

    /**
     * Returns the total end users present under a user.
     * @return mixed
     */
    public function count_end_users() {
        return $this->end_users()->count();
    }

    public function stripe_subscriptions() {
        return $this->hasOne(StripeSubscription::class);
    }
    
}
