<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth as Auth ;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    // Show all reviews
    public function index() {
        $reviews = Review::with('user')->orderBy('id', 'desc')->paginate(10);
        if ($reviews->isEmpty()) {
            return $this->errorResponse('No reviews found.', 404);
        }
        return $this->successResponse($reviews, 'All reviews retrieved successfully.');
    }

    // Show review by ID
    public function show($id) {
        $review = Review::with('user')->find($id);
        if (!$review) {
            return $this->errorResponse('Review not found.', 404);
        }
        return $this->successResponse($review, 'Review retrieved successfully.');
    }

    // Create a new review
    public function store(ReviewRequest $request){
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        // Handle user image upload
        if ($request->hasFile('user_image')) {
            $data['user_image'] = $request->file('user_image')->store('users/images', 'public');
        }

        $review = Review::create($data);
        if (!$review) {
            return $this->errorResponse('Failed to create review.', 500);
        }
        return $this->successResponse($review, 'Review created successfully.');
    }

    // Update review
    public function update(ReviewRequest $request, $id) {
        $review = Review::find($id);
        if (!$review || $review->user_id !== Auth::id()) {
            return $this->errorResponse('Unauthorized user', 403);
        }
        $data = $request->validated();

        // Update user image
        if ($request->hasFile('user_image')) {
            if ($review->user_image) {
                Storage::disk('public')->delete($review->user_image);
            }
            $data['user_image'] = $request->file('user_image')->store('users/images', 'public');
        }

        $updated = $review->update($data);

        if (!$updated) {
            return $this->errorResponse('Failed to update review.', 500);
        }
        return $this->successResponse($review, 'Review updated successfully.');
    }

    // Delete a review
    public function destroy($id) {
        $review = Review::find($id);
        if (!$review || $review->user_id !== Auth::id()) {
            return $this->errorResponse('Unauthorized user', 403);
        }

        // Delete image if exists
        if ($review->user_image) {
            Storage::disk('public')->delete($review->user_image);
        }

        if ($review->delete()) {
            return $this->successResponse(null, 'Review deleted successfully.');
        }
        return $this->errorResponse('Failed to delete review.', 500);
    }
}
