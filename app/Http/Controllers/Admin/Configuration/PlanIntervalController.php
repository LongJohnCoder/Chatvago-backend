<?php

namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Requests\Configuration\PlanIntervalRequest;
use App\StripeSubscriptionPlanInterval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanIntervalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $plan_intervals = StripeSubscriptionPlanInterval::all();
            return view('admin.Pages.Configuration.Plan_Intervals.index',compact('plan_intervals'));

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

            $plan_intervals = config('services.stripe_plans');
            return view('admin.Pages.Configuration.Plan_Intervals.create',compact('plan_intervals'));

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
    public function store(PlanIntervalRequest $request)
    {
        try{

            $plan_interval                  = new StripeSubscriptionPlanInterval();
            $plan_interval->name            = $request->interval_name;
            $plan_interval->interval        = $request->interval;
            $plan_interval->interval_count  = $request->interval_count;
            $plan_interval->save();

            return redirect()->route('intervals.index')->with([
                'success' => true,
                'message' => 'You have successfully configured your subscription plan interval.'
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

        }
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

            $plan_intervals = config('services.stripe_plans');
            $interval = StripeSubscriptionPlanInterval::findOrFail($id);
            return view('admin.Pages.Configuration.Plan_Intervals.edit',compact('plan_intervals','interval'));

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
    public function update(PlanIntervalRequest $request, $id)
    {
        try{

            $plan_interval                  = StripeSubscriptionPlanInterval::findOrFail($id);
            $plan_interval->name            = $request->interval_name;
            $plan_interval->interval        = $request->interval;
            $plan_interval->interval_count  = $request->interval_count;
            $plan_interval->update();

            return redirect()->route('intervals.index')->with([
                'success' => true,
                'message' => 'You have successfully updated your subscription plan interval.'
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

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            $plan_interval  = StripeSubscriptionPlanInterval::findOrFail($request->interval_id);
            $plan_interval->delete();

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
}
