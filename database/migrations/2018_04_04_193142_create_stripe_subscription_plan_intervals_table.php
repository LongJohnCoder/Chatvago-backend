<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeSubscriptionPlanIntervalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_subscription_plan_intervals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('custom');
            $table->string('interval');
            $table->string('interval_count');
            $table->boolean('is_editable')->default(1)->comment('0 => No, 1 => Yes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stripe_subscription_plan_intervals');
    }
}
