@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            تفاصيل جهة الاتصال
        </div>
        <div class="card-body">
            <p><strong>الاسم:</strong> {{ $contact->name }}</p>
            <p><strong>البريد الإلكتروني:</strong> {{ $contact->email }}</p>
            <p><strong>الهاتف:</strong> {{ $contact->phone }}</p>
            <p><strong>العنوان:</strong> {{ $contact->address }}</p>
            <p><strong>الموضوع:</strong> {{ $contact->subject }}</p>
            <p><strong>الرسالة:</strong> {{ $contact->message }}</p>

            @if ($contact->admin_reply)
                <div class="alert alert-success">
                    <strong>رد الإدمن:</strong> {{ $contact->admin_reply }}
                </div>
            @else
                <form action="{{ route('contacts.reply', $contact->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="admin_reply" class="form-label">الرد على الرسالة</label>
                        <textarea class="form-control" id="admin_reply" name="admin_reply" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">إرسال الرد</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
