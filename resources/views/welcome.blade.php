{{-- resources/views/welcome.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket System - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Welcome to the Ticket System</h1>
        <p class="text-muted">Manage support tickets efficiently with Admin, Agent, and User roles.</p>
    </div>

    <div class="row g-4">
        <!-- Admin -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-primary">Admin</h4>
                    <ul class="list-unstyled mt-3">
                        <li>✔ Create, Edit, Delete, Show Tickets</li>
                        <li>✔ Create and Manage Users</li>
                        <li>✔ Create and Manage Projects</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Agent -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-success">Agent</h4>
                    <ul class="list-unstyled mt-3">
                        <li>✔ Create and Show Tickets</li>
                        <li>✔ Reply to Assigned Tickets</li>
                        <li>✔ View and Reply to Unassigned Tickets</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- User -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-warning">User</h4>
                    <ul class="list-unstyled mt-3">
                        <li>✔ Create Tickets</li>
                        <li>✔ Show Tickets</li>
                        <li>✔ Reply to Their Own Tickets</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Login/Register Buttons -->
    <div class="text-center mt-5">
        @guest
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
        @else
            @php
                $prefix = auth()->user()->role;
            @endphp
            <a href="{{ route($prefix . '.home') }}" class="btn btn-success">Go to Dashboard</a>
        @endguest
    </div>
</div>

</body>
</html>
