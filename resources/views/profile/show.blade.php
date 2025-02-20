@extends('layouts.layout')

@section('content')
@include('message')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>ملف التعريف الشخصي</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-right font-weight-bold">الاسم:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-right font-weight-bold">البريد الإلكتروني:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-right font-weight-bold">الصورة:</th>
                                    <td>
                                        @if ($user->image)
                                            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="rounded-circle img-thumbnail" width="100">
                                        @else
                                            <span class="text-muted">لا يوجد صورة</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-success btn-sm">تعديل الملف الشخصي</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
