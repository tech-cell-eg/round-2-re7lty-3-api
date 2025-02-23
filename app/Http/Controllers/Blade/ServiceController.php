<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(){
        $services=Service::orderBy('id','Desc')->paginate(10);
        return view('services.index',compact('services'));
    }
    public function create(){
        return view('services.create');
    }
    public function store(ServiceRequest $request){
        $data=$request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        $service=Service::create($data);
        if($service){
            return redirect()->route('service.index')->with('success', 'تم إنشاء الخدمه بنجاح!');
        }else {
            return back()->withInput()->withErrors(['error' => 'فشل إنشاء الخدمة.']);
        }
    }

    public function edit($id){
        $service=Service::findOrFail($id);
        return view('services.edit',compact('service'));
    }

    public function update(ServiceRequest $request,$id){
        $service=Service::findOrFail($id);
        $data=$request->validated();
        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        elseif (isset($data['image']) && $data['image'] === '') {
            $data['image'] = null;
        }
        $service->update($data);
        return redirect()->route('service.index')->with('success', 'تم تحديث الخدمه بنجاح!');

    }
    public function destroy($id){
        $service=Service::findOrFail($id);
        if (!$service) {
            return redirect()->route('service.index')->with('error', 'الخدمة غير موجودة.');
        }
        if($service->image){
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return redirect()->route('service.index')->with('success', 'تم حذف الخدمة بنجاح!');

    }
}
