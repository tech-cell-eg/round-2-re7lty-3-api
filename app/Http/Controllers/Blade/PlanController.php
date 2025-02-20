<?php

namespace App\Http\Controllers\Blade;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::orderBy('id', 'desc')->paginate(10);
        return view('plans.index', compact('plans'));
    }
    //to show create page
    public function create()
    {
        $options = [
            'business_class' => 'بطاقات سفر بدرجة رجال الأعمال',
            'five_star_hotel' => 'حجز بفندق خمس نجوم',
            'special_follow_up' => 'متابعة خاصة لإحتياجاتك',
            'first_class' => 'بطاقات سفر في الدرجة الأولى',
            'four_star_hotel' => 'حجز بفندق أربع نجوم',
            'daily_excursions' => 'رحلات ميدانية بشكل يومي',
            'economy_class' => 'بطاقات سفر في الدرجة الاقتصادية',
            'three_star_hotel' => 'حجز بفندق ثلاث نجوم',
            'breakfast' => 'وجبات إفطار يومية',
        ];
        return view('plans.create', compact('options'));
    }

    public function store(PlanRequest $request)
    {
        $data = $request->validated();

        //convert json to options
        if (isset($data['options'])) {
            $data['options'] = json_decode($data['options'], true);
        }
        $plan = Plan::create($data);

        if ($plan) {
            return redirect()->route('plan.index')->with('success', 'تمت إضافة الخطة بنجاح.');
        }
        return back()->withInput()->with('error', 'فشل إضافة الخطة.');
    }

    //to show edit page
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $options = [
            'business_class' => 'بطاقات سفر بدرجة رجال الأعمال',
            'five_star_hotel' => 'حجز بفندق خمس نجوم',
            'special_follow_up' => 'متابعة خاصة لإحتياجاتك',
            'first_class' => 'بطاقات سفر في الدرجة الأولى',
            'four_star_hotel' => 'حجز بفندق أربع نجوم',
            'daily_excursions' => 'رحلات ميدانية بشكل يومي',
            'economy_class' => 'بطاقات سفر في الدرجة الاقتصادية',
            'three_star_hotel' => 'حجز بفندق ثلاث نجوم',
            'breakfast' => 'وجبات إفطار يومية',
        ];
        // if ($plan->options) {
        //     $planOptions = json_decode($plan->options, true);
        // } else {
        //     $planOptions = [];
        // }
        return view('plans.edit', compact('plan', 'options'));
    }

    public function update(PlanRequest $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $data = $request->validated();
        if (isset($data['options'])) {
            $data['options'] = json_decode($data['options'], true);
        }
        if ($plan->update($data)) {
            return redirect()->route('plan.index')->with('success', 'تم تحديث الخطة بنجاح.');
        }
        return back()->withInput()->with('error', 'فشل تحديث الخطة.');
    }
    //to delete
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        if ($plan->delete()) {
            return redirect()->route('plan.index')->with('success', 'تم حذف الخطة بنجاح.');
        }

        return back()->with('error', 'فشل حذف الخطة.');
    }
}
