@extends('layouts.layout')
@section('content')
<div class="container mt-5">
    @include('message') <!-- لإظهار رسائل النجاح أو الخطأ -->

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-primary">الخطط</h1>
        <a href="{{ route('plan.create') }}" class="btn btn-success">إضافة خطة جديدة</a>
    </div>

    <style>
        body {
            background-color: #f8f9fa; /* خلفية بيضاء ناعمة */
        }

        .custom-table {
            background-color: #ffffff; /* خلفية البيج للجدول */
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
            background-color: #eef6ff; /* لون رأس الجدول */
            color: #333;
            font-weight: bold;
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f3f7fb; /* تبديل الألوان بين الصفوف */
        }

        .custom-table tbody tr:hover {
            background-color: #eef6ff; /* لون عند Hover */
        }

        .custom-table .action-btns a,
        .custom-table .action-btns button {
            margin: 2px;
        }

        .custom-table .action-btns .btn-warning {
            background-color: #199b37 !important; /* لون زر التعديل */
            border-color: #28a745 !important;
        }

        .custom-table .action-btns .btn-warning:hover {
            background-color: #218838 !important;
            border-color: #1e7e34 !important;
        }

        .custom-table .action-btns .btn-danger {
            background-color: #dc3545 !important; /* لون زر الحذف */
            border-color: #dc3545 !important;
        }

        .custom-table .action-btns .btn-danger:hover {
            background-color: #c82333 !important;
            border-color: #bd2130 !important;
        }

        .alert-empty {
            background-color: #fff3cd; /* لون تحذير أنيق */
            color: #856404;
            border-color: #ffeeba;
            padding: 15px;
            border-radius: 8px;
        }
    </style>

    @if ($plans->isEmpty())
        <div class="alert alert-empty text-center" role="alert">
            لا توجد خطط متاحة حاليًا.
        </div>
    @else
        <table class="table custom-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">السعر</th>
                    <th scope="col">نوع الخطة</th>
                    <th scope="col">نوع المستفيد</th>
                    <th scope="col">الوصف</th>
                    <th scope="col">الخيارات</th>
                    <th scope="col" class="text-center">**</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr>
                        <td>{{ $plan->id }}</td>
                        <td>${{ number_format($plan->price, 2) }}</td>
                        <td>{{ ucfirst($plan->plan_type) }}</td>
                        <td>{{ ucfirst($plan->target_type) }}</td>
                        <td>{{ Str::limit($plan->description, 50, '...') }}</td>
                        <td>
                            @if (!empty($plan->options))
                                <ul class="list-unstyled">
                                    @foreach ((is_array($plan->options) ? $plan->options : json_decode($plan->options, true) ?? []) as $index => $value)
                                        <li><strong>{{ $loop->iteration }}:</strong> {{ $value }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">لا توجد خيارات.</span>
                            @endif
                        </td>



                        <td class="text-center action-btns">
                            <div class="btn-group" role="group">
                                <!-- زر تعديل -->
                                <a href="{{ route('plan.edit', $plan->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> تعديل
                                </a>
                                <!-- زر حذف -->
                                <form action="{{ route('plan.destroy', $plan->id) }}" method="POST" class="d-inline">
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
            {{ $plans->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
