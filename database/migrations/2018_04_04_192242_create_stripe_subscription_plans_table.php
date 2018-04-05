<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripeSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_subscription_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plan_name');
            $table->string('plan_id');
            $table->string('plan_price');
            $table->string('plan_interval');
            $table->string('plan_features');
            $table->integer('profile_creation');
            $table->integer('page_creation_per_profile');
            $table->boolean('avail_broadcast');
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
        Schema::dropIfExists('stripe_subscription_plans');
    }
}
