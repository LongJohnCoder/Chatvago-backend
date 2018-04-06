<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stripe_subscription_plan_intervals')->insert([

                ['name' => 'Daily',  'interval' => 'day',   'interval_count' => '1', 'is_editable' => '0'],
                ['name' => 'Weekly', 'interval' => 'week',  'interval_count' => '1', 'is_editable' => '0'],
                ['name' => 'Monthly','interval' => 'month', 'interval_count' => '1', 'is_editable' => '0'],
                ['name' => 'Yearly', 'interval' => 'year',  'interval_count' => '1', 'is_editable' => '0']

        ]);
    }
}
