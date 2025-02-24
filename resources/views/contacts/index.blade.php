@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    @include('message')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-primary">جهات الاتصال</h1>
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
    </style>

    @if ($contacts->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            لا توجد جهات اتصال متاحة حاليًا.
        </div>
    @else
        <table class="table custom-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">الاسم</th>
                    <th scope="col">البريد الإلكتروني</th>
                    <th scope="col">الهاتف</th>
                    <th scope="col">العنوان</th>
                    <th scope="col">الرسالة</th>
                    <th scope="col">الرد</th>
                    <th scope="col">الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ Str::limit($contact->address, 50, '...') }}</td>
                        <td>{{ Str::limit($contact->message, 50, '...') }}</td>
                        <td>
                            @if ($contact->admin_reply)
                                <span class="text-success">{{ Str::limit($contact->admin_reply, 50, '...') }}</span>
                            @else
                                <span class="text-danger">لم يتم الرد بعد</span>
                            @endif
                        </td>
                        <td class="text-center action-btns">
                            <div class="btn-group" role="group">
                                @if (!$contact->admin_reply)
                                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-reply"></i> رد
                                    </a>
                                @endif
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
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
            {{ $contacts->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
