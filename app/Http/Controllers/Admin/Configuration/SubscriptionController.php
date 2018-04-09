<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\StripeSubscriptionPlanInterval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StripeSubscriptionPlan;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Configuration\SubscriptionRequest;
use Cartalyst\Stripe\Stripe as Stripe;
use Cartalyst\Stripe\Exception\CardErrorException as StripeException;

class SubscriptionController extends Controller
{
    /**
     * @var string
     */
    protected $stripe;

    /**
     * SubscriptionController constructor.
     */
    public function __construct()
    {
        $this->stripe = new Stripe(config('services.stripe.secret'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $subscription_plans = StripeSubscriptionPlan::all();
            return view('admin.Pages.Configuration.Subscriptions.index',compact('subscription_plans'));

        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $model_not_found) {

            return view('errors.error',[
                'code' => $model_not_found->getCode(),
                'message' => $model_not_found->getMessage()
            ]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{

            $intervals = StripeSubscriptionPlanInterval::pluck('name','id')->toArray();
            return view('admin.Pages.Configuration.Subscriptions.create',compact('intervals'));

        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $model_not_found) {

            return view('errors.error',[
                'code' => $model_not_found->getCode(),
                'message' => $model_not_found->getMessage()
            ]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionRequest $request)
    {

        $checkStripe = $this->stripePlanExists($request);

        if($checkStripe) {

            return redirect()->route('subscriptions.index')->with([
                'success' => false,
                'message' => 'Unfortunately the stripe plan already exists. Please try with some other id.'
            ]);
        }

        try{

            $stripe_plan = $this->storeSubscriptionData($request);
            $this->createStripePlan($stripe_plan);
            
            return redirect()->route('subscriptions.index')->with([
                'success' => true,
                'message' => 'You have successfully configured your subscription plan.'
            ]);
            
        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $model_not_found) {

            return view('errors.error',[
                'code' => $model_not_found->getCode(),
                'message' => $model_not_found->getMessage()
            ]);

        } catch(StripeException $stripe_exception){

            return view('errors.error',[
                'code' => $stripe_exception->getCode(),
                'message' => $stripe_exception->getMessage()
            ]);
        }
    }

    /**
     * Check whether the stripe plan exists on stripe or not.
     * @param $request
     * @return bool
     */
    protected function stripePlanExists($request) {

        try {

            $plan_exists = $this->stripe->plans()->find($request->plan_id);
            if(!empty($plan_exists)) {
                return true;
            }
            return false;

        } catch(Exception $stripe_exception){

            return false;
        }
    }
    /**
     * Stores subscription data in the database
     * @param $request
     */
    protected function storeSubscriptionData($request) {
        $stripe_plan                                = new StripeSubscriptionPlan();
        $stripe_plan->plan_name                     = $request->plan_name;
        $stripe_plan->plan_id                       = $request->plan_id;
        $stripe_plan->plan_price                    = $request->plan_price;
        $stripe_plan->plan_interval                 = $request->plan_interval;
        $stripe_plan->plan_features                 = $this->createStripeFeature($request);
        $stripe_plan->profile_creation              = $request->profile_creation;
        $stripe_plan->page_creation_per_profile     = $request->pages_per_user;
        $stripe_plan->avail_broadcast               = isset($request->avail_broadcast) ?  $request->avail_broadcast : "0";
        $stripe_plan->save();

        return $stripe_plan;
    }

    /**
     * Creates a stripe feature.
     * @param $request
     */
    protected function createStripeFeature($request) {
        $feature = 'Total User Profiles : '.$request->profile_creation.',Total Pages Per User : '.$request->pages_per_user.',Broadcasting : '.(isset($request->avail_broadcast) ?  "On" : "Off");
        return $feature;
    }

    /**
     * Creates a plan in stripe
     * @param $request
     */
    protected function createStripePlan($stripe_plan) {
        $this->stripe->plans()->create([
            'id'                    => $stripe_plan->plan_id,
            'name'                  => $stripe_plan->plan_name,
            'amount'                => $stripe_plan->plan_price,
            'currency'              => 'USD',
            'interval'              => (!is_null($stripe_plan->interval)) ? $stripe_plan->interval->interval : 'day',
            'interval_count'        => (!is_null($stripe_plan->interval)) ? $stripe_plan->interval->interval_count : '1',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $intervals = StripeSubscriptionPlanInterval::pluck('name','id')->toArray();
            $subscription_plan = StripeSubscriptionPlan::findOrFail($id);
            return view('admin.Pages.Configuration.Subscriptions.edit',compact('subscription_plan','intervals'));

        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $modelNotFound) {

            return view('errors.error',[
                'code' => $modelNotFound->getCode(),
                'message' => $modelNotFound->getMessage()
            ]);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubscriptionRequest $request, $id)
    {
        $checkStripe = $this->stripePlanExists($request);

        try {

            if ($checkStripe) {

                $stripe_plan    = $this->updateSubscriptionData($request,$id);
                $this->updateStripePlan($stripe_plan);

                return redirect()->route('subscriptions.index')->with([
                    'success' => true,
                    'message' => 'You have successfully updated your subscription configuration.'
                ]);

            } else {

                $stripe_plan    =   StripeSubscriptionPlan::findOrFail($id);
                $stripe_plan->delete();

                return redirect()->route('subscriptions.index')->with([
                    'success' => false,
                    'message' => 'Oops! It seems like the stripe plan does not exist on stripe.'
                ]);
            }


        } catch (Exception $exception) {

            return view('errors.error',[
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ]);

        } catch (ModelNotFoundException $modelNotFound) {

            return view('errors.error',[
                'code' => $modelNotFound->getCode(),
                'message' => $modelNotFound->getMessage()
            ]);

        }
    }

    /**
     * Updates stripe data in database
     * @param $request
     * @param $id
     */
    protected function updateSubscriptionData($request,$id) {

        $stripe_plan                                = StripeSubscriptionPlan::findOrFail($id);
        $stripe_plan->plan_name                     = $request->plan_name;
        $stripe_plan->plan_features                 = $this->createStripeFeature($request);
        $stripe_plan->profile_creation              = $request->profile_creation;
        $stripe_plan->page_creation_per_profile     = $request->pages_per_user;
        $stripe_plan->avail_broadcast               = isset($request->avail_broadcast) ?  $request->avail_broadcast : "0";
        $stripe_plan->update();

        return $stripe_plan;
    }

    /**
     * Updates stripe plan on stripe.
     * @param $stripe_plan
     */
    protected function updateStripePlan($stripe_plan) {
        $this->stripe->plans()->update( $stripe_plan->plan_id , [
            'name'                  => $stripe_plan->plan_name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $checkStripe = $this->stripePlanExists($request);
        try {

            $this->deleteStripeData($request);
            if($checkStripe) {
                $this->deleteStripePlan($request);
            }

            return response()->json([
                'success'       => true,
                'message'       => 'Successfully deleted the subscription'
            ],200);


        } catch (Exception $exception) {

            return response()->json([
                'success'       => false,
                'code'          => $exception->getCode(),
                'message'       => $exception->getMessage()
            ],($exception->getCode() != 0) ? $exception->getCode() : 500);

        } catch (ModelNotFoundException $modelNotFound) {

            return response()->json([
                'success'       => false,
                'code'          => $modelNotFound->getCode(),
                'message'       => $modelNotFound->getMessage()
            ],($modelNotFound->getCode() != 0) ? $modelNotFound->getCode() : 500);
        }
    }

    /**
     * Deletes the data from database
     * @param $request
     */
    protected function deleteStripeData($request) {
        $subscription_plan = StripeSubscriptionPlan::findOrFail($request->subscription_id);
        $subscription_plan->delete();
    }

    /**
     * Delete the stripe plan from stripe
     * @param $request
     */
    protected function deleteStripePlan($request) {
        $this->stripe->plans()->delete($request->plan_id);
    }
}
