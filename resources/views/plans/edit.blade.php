@extends('layouts.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>تعديل الخطة</h3>
                </div>
                <div class="card-body">
                    @include('message')
                    <form action="{{ route('plan.update', $plan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="price" class="form-label font-weight-bold">السعر:</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $plan->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="plan_type" class="form-label font-weight-bold">نوع الخطة:</label>
                            <select name="plan_type" id="plan_type" class="form-select @error('plan_type') is-invalid @enderror" required>
                                <option value="" disabled {{ old('plan_type', $plan->plan_type) == '' ? 'selected' : '' }}>اختر نوع الخطة</option>
                                <option value="economic" {{ old('plan_type', $plan->plan_type) == 'economic' ? 'selected' : '' }}>اقتصادية</option>
                                <option value="family" {{ old('plan_type', $plan->plan_type) == 'family' ? 'selected' : '' }}>عائلية</option>
                                <option value="business" {{ old('plan_type', $plan->plan_type) == 'business' ? 'selected' : '' }}>تجارية</option>
                            </select>
                            @error('plan_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="target_type" class="form-label font-weight-bold">نوع المستفيد:</label>
                            <select name="target_type" id="target_type" class="form-select @error('target_type') is-invalid @enderror" required>
                                <option value="" disabled {{ old('target_type', $plan->target_type) == '' ? 'selected' : '' }}>اختر نوع المستفيد</option>
                                <option value="individual" {{ old('target_type', $plan->target_type) == 'individual' ? 'selected' : '' }}>فرد</option>
                                <option value="group" {{ old('target_type', $plan->target_type) == 'group' ? 'selected' : '' }}>مجموعة</option>
                            </select>
                            @error('target_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label font-weight-bold">الوصف:</label>
                            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $plan->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="options" class="form-label font-weight-bold">الخيارات:</label>
                            <textarea name="options" id="options" class="form-control @error('options') is-invalid @enderror" rows="4" placeholder="أدخل كل خيار في سطر جديد">
                                {{ old('options', $planOptions) }}
                            </textarea>
                            @error('options')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg w-100">تحديث الخطة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
