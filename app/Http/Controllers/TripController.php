<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Storage;


class TripController extends Controller
{
    use ApiResponseTrait;

    //show all trip
    public function index(){
        $trips=Trip::orderBy('id','desc')->paginate(8);
        if($trips->isEmpty()){
            return $this->errorResponse('No trips found.', 404);
        }
        return $this->successResponse($trips, 'All trips retrieved successfully.');
    }
    //show trip by id
    public function show($id){
        $trip=Trip::find($id);
        if(!$trip){
            return $this->errorResponse('Trip not found.', 404);
        }
        return $this->successResponse($trip, 'Trip retrieved successfully.');
    }
    //to create new trip
    public function store(TripRequest $request){
        $data=$request->validated();
        if (empty($data)) {
            return $this->errorResponse('Validation failed.', 400);
        }
        //image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('trips', 'public');
        }
        $trip = Trip::create($data);
        if (!$trip) {
            return $this->errorResponse('Failed to create trip.', 500);
        }
        return $this->successResponse($trip, 'Trip created successfully.');
    }

    //to update trip
    public function update(TripRequest $request,$id){
        $trip=Trip::find($id);
        if(!$trip){
            return $this->errorResponse('Trip not found.', 404);
        }
        $data = $request->validated();
        if (empty($data)) {
            return $this->errorResponse('Validation failed.', 400);
        }
        //image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('trips', 'public');
        }
        $updatedTrip = $trip->update($data);
        if (!$updatedTrip) {
            return $this->errorResponse('Failed to update trip.', 500);
        }
        return $this->successResponse($trip, 'Trip updated successfully.');
    }

    //to delete trip
    public function destroy($id) {
        $trip = Trip::find($id);
        if (!$trip) {
            return $this->errorResponse('Trip not found.', 404);
        }
        if ($trip->image) {
            Storage::disk('public')->delete($trip->image);
        }
        if ($trip->delete()) {
            return $this->successResponse(null, 'Trip deleted successfully.');
        }
        return $this->errorResponse('Failed to delete trip.', 500);
    }
}
