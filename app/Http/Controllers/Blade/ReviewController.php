<?php

namespace App\Http\Controllers\Blade;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::orderBy('id', 'desc')->paginate(10);
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('reviews.create');
    }

    public function store(ReviewRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('reviews', 'public');
        }
        $data['user_id'] = Auth::id();
        $review = Review::create($data);
        if ($review) {
            return redirect()->route('review.index')->with('success', 'تمت إضافة الشهادة بنجاح.');
        }
        return back()->withInput()->with('error', 'فشل إضافة اشهادة.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.edit', compact('review'));
    }
    public function update(ReviewRequest $request, $id)
    {
        $review = Review::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($review->image) {
                Storage::disk('public')->delete($review->image);
            }
            $data['image'] = $request->file('image')->store('reviews', 'public');
        }
        elseif (isset($data['image']) && $data['image'] === '') {
            $data['image'] = null;
        }

        $review->update($data);
        if ($review->update($data)) {
            return redirect()->route('review.index')->with('success', 'تم تحديث الشهادة بنجاح.');
        }
        return back()->withInput()->with('error', 'فشل تحديث الشهادة.');    }


    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->image) {
            Storage::disk('public')->delete($review->image);
        }
       if ($review->delete()) {
            return redirect()->route('review.index')->with('success', 'تم حذف الشهادة بنجاح.');
        }

        return back()->with('error', 'فشل حذف اشهادة.');
    }

}
