@extends('layouts.layout')
@section('content')
<div class="container mt-5">
    @include('message')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-primary">الخدمات</h1>
        <a href="{{ route('service.create') }}" class="btn btn-success">إضافة خدمة جديدة</a>
    </div>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .custom-table {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }

        .custom-table th,
        .custom-table td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: center;
            vertical-align: middle;
        }

        .custom-table thead {
            background-color: #eef6ff;
            color: #333;
            font-weight: bold;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f3f7fb;
        }

        .custom-table tbody tr:hover {
            background-color: #eef6ff;
        }

        .custom-table .action-btns a,
        .custom-table .action-btns button {
            margin: 2px;
        }

        .custom-table .action-btns .btn-warning {
            background-color: #199b37 !important;
            border-color: #28a745 !important;
        }

        .custom-table .action-btns .btn-warning:hover {
            background-color: #218838 !important;
            border-color: #1e7e34 !important;
        }

        .custom-table .action-btns .btn-danger {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .custom-table .action-btns .btn-danger:hover {
            background-color: #c82333 !important;
            border-color: #bd2130 !important;
        }

        .custom-table img {
            border-radius: 50%;
            border: 1px solid #ddd;
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .alert-empty {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeeba;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
    @if ($services->isEmpty())
        <div class="alert alert-empty text-center" role="alert">
            لا توجد خدمات متاحة حاليًا.
        </div>
    @else
        <table class="table custom-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">أسم الخدمة</th>
                    <th scope="col">الوصف</th>
                    <th scope="col">الصورة</th>
                    <th scope="col" class="text-center">**</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>
                            @if ($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="service Image" class="rounded-circle img-thumbnail">
                            @else
                                <span class="text-muted">لا يوجد صورة</span>
                            @endif
                        </td>
                        <td class="text-center action-btns">
                            <div class="btn-group" role="group">
                                <a href="{{ route('service.edit', $service->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> تعديل
                                </a>
                                <form action="{{ route('service.destroy', $service->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                        <i class="fa fa-trash"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $services->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
