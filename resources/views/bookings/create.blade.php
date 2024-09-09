@extends('layouts.app')

@section('content')
    <h1>Room Booking</h1>
    <form id="bookingForm">
        <div>
            <label>Customer Name:</label>
            <input type="text" name="customer_name" >
        </div>
        <div>
            <label>Start Date:</label>
            <input type="date" name="start_date" >
        </div>
        <div>
            <label>End Date:</label>
            <input type="date" name="end_date" >
        </div>
        <div>
            <label>Room:</label>
            <select name="room_id" id="roomSelect" >
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->room_no }} - {{ $room->room_type }}</option>
                @endforeach
            </select>
        </div>
        <div id="costContainer">
            
        </div>
        <button type="submit">Book</button>
    </form>

    <script>
       $(document).ready(function() {
    const bookingForm = $('#bookingForm');
    const roomSelect = $('#roomSelect');
    const costContainer = $('#costContainer');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    function updateCost() {
        const roomId = roomSelect.val();
        const startDate = $('input[name="start_date"]').val();
        const endDate = $('input[name="end_date"]').val();

        if (roomId && startDate && endDate) {
            $.ajax({
                url: `{{ route('rooms.calculateCost', ':roomId') }}`.replace(':roomId', roomId),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    if (response.success) {
                        costContainer.html(`<p>Total Cost: $${response.cost.toFixed(2)}</p>`);
                    } else {
                        costContainer.html(`<p>Error calculating cost.</p>`);
                    }
                },
                error: function() {
                    costContainer.html(`<p>Error calculating cost.</p>`);
                }
            });
        } else {
            costContainer.html('');
        }
    }

    // Handle form submission
    bookingForm.on('submit', function(e) {
        e.preventDefault();

        const formData = bookingForm.serialize(); // Serialize form data

        $.ajax({
            url: `{{ route('bookings.store') }}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: formData,
            success: function(response) {
                if (response.success) {
                    alert('Booking successful!');
                    bookingForm[0].reset(); // Reset the form
                    costContainer.html(''); // Clear cost display
                } else {
                    alert('Error: ' + (response.message || 'An error occurred'));
                }
            },
            error: function() {
                alert('An error occurred during booking.');
            }
        });
    });

    roomSelect.on('change', updateCost);
    $('input[name="start_date"], input[name="end_date"]').on('change', updateCost);
});

    </script>
@endsection
