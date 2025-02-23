@extends('layouts.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h3>تعديل رحلة</h3>
                </div>
                <div class="card-body">
                    @include('message')

                    <form action="{{ route('trip.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="location" class="form-label">المكان:</label>
                            <input type="text" name="location" id="location" class="form-control form-control-lg @error('location') is-invalid @enderror" value="{{ old('location', $trip->location) }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">السعر:</label>
                            <input type="number" name="price" id="price" class="form-control form-control-lg @error('price') is-invalid @enderror" value="{{ old('price', $trip->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="duration_days" class="form-label">مدة الرحلة (أيام):</label>
                            <input type="number" name="duration_days" id="duration_days" class="form-control form-control-lg @error('duration_days') is-invalid @enderror" value="{{ old('duration_days', $trip->duration_days) }}" required>
                            @error('duration_days')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">صورة الرحلة:</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if ($trip->image)
                                <img src="{{ asset('storage/' . $trip->image) }}" alt="Trip Image" width="150" class="mt-2 img-thumbnail">
                            @else
                                <p class="text-muted mt-2">لا يوجد صورة مرفقة.</p>
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-100">حفظ التغييرات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
