@extends('layouts.master')

@section('content')

    <div class="container">
        <h3>Calendar:</h3>
        <div id="calendar">


        </div>

    </div>

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type='text/javascript'>

        $(document).ready(function() {

            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
                events:'/cal'
            })

        });

    </script>
@endsection