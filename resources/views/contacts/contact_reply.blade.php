<!DOCTYPE html>
<html>
<head>
    <title>رد على استفسارك</title>
</head>
<body>
    <h3>مرحبًا {{ $contact->name }}</h3>
    <p>شكرًا على تواصلك معنا.</p>
    <p>الرد الخاص بك:</p>
    <blockquote>{{ $contact->admin_reply }}</blockquote>
    <p>تحياتنا، فريق الدعم</p>
</body>
</html>
