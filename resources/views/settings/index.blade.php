@extends('layouts.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">إعدادات الموقع</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('site.settings.update') }}">
        @csrf

        @foreach($settings as $setting)
            <div class="mb-3">
                <label class="form-label">{{ __('settings.' . $setting->key) }}</label>
                <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-control">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
    </form>
</div>
@endsection
