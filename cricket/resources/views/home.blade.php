@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="message">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Matches</div>

                <div class="card-body matches">
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>

    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;

    var pusher = new Pusher('0cbb9d3e60d2f0cc09c2', {
        cluster: 'ap2',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        if(data.matches == null){
            $(".message").html('');
            $(".message").html(data.message);
        }
        if(data.matches != null){
            $(".message").html('');
            $(".message").html(data.message);
            $.each(data.matches, function(key, value){
                $(".matches").append('<p>'+value+'</p>');
            });
        }
    });
    </script>
@endsection