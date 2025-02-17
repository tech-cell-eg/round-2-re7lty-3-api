<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\PlanRequest;

class PlanController extends Controller
{
    use ApiResponseTrait;
    //show all plans
    public function index(){
        $plans=Plan::orderBy('id', 'desc')->paginate(10);
        if ($plans->isEmpty()) {
            return $this->errorResponse('No plans found.', 404);
        }
        return $this->successResponse($plans, 'All plans retrieved successfully.');
    }
    //show plane by id
    public function show($id){
        $plan=Plan::find($id);
        if (!$plan) {
            return $this->errorResponse('Plan not found.', 404);
        }

        return $this->successResponse($plan, 'Plan retrieved successfully.');
    }

    //create new plane
    public function store(PlanRequest $request){
        $data = $request->validated();
        if (empty($data)) {
            return $this->errorResponse('Validation failed.', 400);
        }
        $plan = Plan::create($data);
        if (!$plan) {
            return $this->errorResponse('Failed to create plan.', 500);
        }

        return $this->successResponse($plan, 'Plan created successfully.');
    }

    //update the plane

    public function update(PlanRequest $request ,$id){
        $plan = Plan::find($id);
        if (!$plan) {
            return $this->errorResponse('Plan not found.', 404);
        }
        $data = $request->validated();
        if (empty($data)) {
            return $this->errorResponse('Validation failed.', 400);
        }
        $updated = $plan->update($data);
        if (!$updated) {
            return $this->errorResponse('Failed to update plan.', 500);
        }
        return $this->successResponse($plan, 'Plan updated successfully.');
    }

    //to delete plan
    public function destroy($id){
        $plan = Plan::find($id);
        if (!$plan) {
            return $this->errorResponse('Plan not found.', 404);
        }
        if ($plan->delete()) {
            return $this->successResponse(null, 'Plan deleted successfully.');
        }
        return $this->errorResponse('Failed to delete plan.', 500);
    }
}
