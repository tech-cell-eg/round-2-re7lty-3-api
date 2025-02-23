@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1>تعديل شهادة</h1>

    <form action="{{ route('review.update', $review->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">الاسم:</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $review->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">المحتوى:</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="4" required>{{ old('content', $review->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">التقييم:</label>
            <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5</option>
            </select>
            @error('rating')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">الصورة:</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($review->image)
                <img src="{{ asset('storage/' . $review->image) }}" alt="Current Image" class="mt-2 rounded img-thumbnail" width="100">
            @else
                <p class="text-muted mt-2">لا يوجد صورة مرفقة.</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
    </form>
</div>
@endsection
