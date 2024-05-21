<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Competition Notification</title>
</head>
<body>
<h2>Hello {{ $user->name }},</h2>

<p>We are excited to inform you about a new competition: <strong>{{ $competition->title }}</strong></p>
<p>Description: {{ $competition->description }}</p>
<p>Start Date: {{ $competition->start_date }}</p>
<p>End Date: {{ $competition->end_date }}</p>
<p>Submission Date: {{ $competition->submission_date }}</p>

<p>Thank you for participating!</p>

<p>Sincerely,<br> Your Application Team</p>
</body>
</html>
