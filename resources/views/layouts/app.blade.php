<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Hotel Booking System</title>
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('rooms.index') }}">Rooms</a></li>
                <li><a href="{{ route('bookings.create') }}">Book a Room</a></li>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Hotel Booking System</p>
    </footer>

</body>
</html>
