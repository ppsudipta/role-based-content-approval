<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Role-Based Content Approval System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CDN (No npm needed) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex align-items-center justify-content-center">

    <div class="card shadow-lg p-5 text-center" style="max-width: 600px; width:100%;">
        
        <h1 class="mb-3 text-primary">
            🚀 Role-Based Content Approval System
        </h1>

        <p class="lead text-muted">
            A clean Laravel 12 application demonstrating:
        </p>

        <ul class="list-group list-group-flush text-start mb-4">
            <li class="list-group-item">✔ Author Post Submission</li>
            <li class="list-group-item">✔ Manager/Admin Approval Workflow</li>
            <li class="list-group-item">✔ Activity Logging</li>
            <li class="list-group-item">✔ Policy-Based Authorization</li>
            <li class="list-group-item">✔ RESTful API + Admin Panel</li>
            <li class="list-group-item">✔ PHPUnit Feature Tests</li>
        </ul>

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                Login to Continue
            </a>
        @else
            <a href="{{ route('posts.index') }}" class="btn btn-success btn-lg">
                Go to Dashboard
            </a>
        @endguest

    </div>

</div>

</body>
</html>