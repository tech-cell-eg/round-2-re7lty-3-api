@extends('layouts.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>إعدادات الحساب</h3>
                </div>
                <div class="card-body">
                    @include('message') <!-- لإظهار رسائل النجاح أو الأخطاء -->
                    <form action="{{ route('email.update') }}" method="POST" class="mb-4">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="email" class="form-label font-weight-bold">البريد الإلكتروني:</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">تحديث البريد الإلكتروني</button>
                    </form>

                    <!-- تعديل كلمة المرور -->
                    <form action="{{ route('password.change') }}" method="POST" class="mb-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label font-weight-bold">كلمة المرور الحالية:</label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label font-weight-bold">كلمة المرور الجديدة:</label>
                            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label font-weight-bold">تأكيد كلمة المرور الجديدة:</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">تحديث كلمة المرور</button>
                    </form>

                    <!-- تسجيل الخروج -->
                    <form action="{{ route('logout') }}" method="POST" class="text-center">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">تسجيل الخروج</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
