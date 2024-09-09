@extends('layouts.app')

@section('content')
    <h1>Room Details Master</h1>
    <form id="roomForm">
        @csrf

        <div>
            <label>Room No:</label>
            <input type="text" name="room_no" required>
        </div>

        <div>
            <label>Room Type:</label>
            <select name="room_type" required>
                <option value="Deluxe">Deluxe</option>
                <option value="Luxury">Luxury</option>
                <option value="Royal">Royal</option>
            </select>
        </div>

        <div>
            <label>Amenities:</label>
            <input type="checkbox" name="bathtub" value="1"> Bathtub
            <input type="checkbox" name="balcony" value="1"> Balcony
            <input type="checkbox" name="mini_bar" value="1"> Mini Bar
        </div>

        <div>
            <label>Max Occupancy:</label>
            <input type="number" name="max_occupancy" required>
        </div>

        <div>
            <label>Room Rent:</label>
            <input type="number" name="rate_per_day" step="0.01" min="0" required> 

        <button type="submit">Save</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#roomForm').on('submit', function(e) {
                e.preventDefault(); 

                var formData = $(this).serialize(); 

                $.ajax({
                    url: '{{ route('rooms.store') }}', 
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Room saved successfully!');
                            $('#roomForm')[0].reset(); 
                        } else {
                            alert('Error saving room. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Error saving room. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
