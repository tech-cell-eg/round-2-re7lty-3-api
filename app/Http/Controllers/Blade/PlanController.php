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
        return view('plans.create');
    }

    public function store(PlanRequest $request)
    {
        $data = $request->validated();

        // تحويل الخيارات إلى مصفوفة ثم إلى JSON
        if (isset($data['options'])) {
            $data['options'] = json_encode($this->prepareOptions($data['options']));
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

        // تحويل JSON إلى نص عادي لعرضه في النموذج
        $planOptions = '';
        if ($plan->options) {
            $planOptions = implode(PHP_EOL, json_decode($plan->options, true));
        }

        return view('plans.edit', compact('plan', 'planOptions'));
    }

    public function update(PlanRequest $request, $id)
    {
        $plan = Plan::findOrFail($id);
        $data = $request->validated();

        // تحويل الخيارات إلى مصفوفة ثم إلى JSON
        if (isset($data['options'])) {
            $data['options'] = json_encode($this->prepareOptions($data['options']));
        }

        if ($plan->update($data)) {
            return redirect()->route('plan.index')->with('success', 'تم تحديث الخطة بنجاح.');
        }

        return back()->withInput()->with('error', 'فشل تحديث الخطة.');
    }


    protected function prepareOptions($options)
    {
        if (!is_array($options)) {
            // تقسيم النصوص إلى مصفوفة بناءً على الأسطر
            $options = explode(PHP_EOL, trim($options));
            // إزالة العناصر الفارغة
            $options = array_filter($options);
        }
        return $options;
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
