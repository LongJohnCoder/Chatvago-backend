<?php

namespace App\Providers;

use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;
use App\StripeSubscriptionPlan;
use Exception;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Your Company',
        'product' => 'Your Product',
        'street' => 'PO Box 111',
        'location' => 'Your Town, NY 12345',
        'phone' => '555-555-5555',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        //
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {

        //Spark::useStripe()->noCardUpFront()->trialDays(10);

        try {
            Spark::useStripe();

            $all_plans = StripeSubscriptionPlan::all();
            if(count($all_plans) > 0) {

                foreach ($all_plans as $key => $each_plan) {

                    Spark::plan($each_plan->plan_name, $each_plan->plan_id)
                        ->price((double)$each_plan->plan_price)
                        ->features(explode(',', $each_plan->plan_features));

                }

            } else {

                Spark::freePlan()
                    ->features([
                        'Total User Profiles : 0', 'Total pages per user : 0', 'Avail broadcast : 0'
                    ]);

            }
        } catch (Exception $exception) {

            return false;
        }


/*
        Spark::freePlan()
            ->features([
                'First', 'Second', 'Third'
            ]);

        //Spark::useStripe()->trialDays(10);

        Spark::plan('Basic', 'basic-plan-1')
            ->price(9.99)
            ->features([
                'First', 'Second', 'Third'
            ]);

        Spark::plan('Premium', 'premium-pack-2')
            ->price(29.99)
            ->features([
                'First', 'Second', 'Third'
            ]);*/
    }
}
