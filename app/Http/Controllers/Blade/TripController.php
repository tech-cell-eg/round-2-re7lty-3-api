<?php

namespace App\Http\Controllers\Blade;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Requests\TripRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;




class TripController extends Controller
{
    //show all trip
    public function index(){
        $trips = Trip::orderBy('id', 'desc')->paginate(8);
        return view('trips.index', compact('trips'));
    }
    //show trip by id
    public function create()
    {
        return view('trips.create');
    }

    //to create new trip
    public function store(TripRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('trips', 'public');
        }
        $trip = Trip::create($data);
        if ($trip) {
            return redirect()->route('trip.index')->with('success', 'تم إنشاء الرحلة بنجاح!');
        } else {
            return back()->withInput()->withErrors(['error' => 'فشل إنشاء الرحلة.']);
        }
    }

    public function edit($id){
        $trip=Trip::findOrFail($id);
        return view('trips.edit',compact('trip'));
    }

    //to update trip
    public function update(TripRequest $request,$id){
        $trip = Trip::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($trip->image) {
                Storage::disk('public')->delete($trip->image);
            }
            $data['image'] = $request->file('image')->store('trips', 'public');
        }
        elseif (isset($data['image']) && $data['image'] === '') {
            $data['image'] = null;
        }
        $trip->update($data);
        return redirect()->route('trip.index')->with('success', 'تم تحديث الرحلة بنجاح!');
    }

    //to delete trip
    public function destroy($id) {
        $trip = Trip::find($id);
        if (!$trip) {
            return redirect()->route('trip.index')->with('error', 'الرحلة غير موجودة.');
        }
        if ($trip->image) {
            Storage::disk('public')->delete($trip->image);
        }
         $trip->delete();
         return redirect()->route('trip.index')->with('success', 'تم حذف الرحلة بنجاح!');
    }
}
