@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Order Tracker</div>

                <div class="panel-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    
                    <order-progress status="{{$order->status->name}}" initial="{{$order->status->percent}}" order_id="{{$order->id}}"></order-progress>
                    {{-- pass user id to show the alert only for current user's orders --}}
                    <order-alert user_id="{{Auth::user()->id}}"></order-alert>
                    <hr>

                    <div class="order-details">
                        <strong>Order ID:</strong> {{ $order->id }} <br>
                        <strong>Size:</strong> {{ $order->size }} <br>
                        <strong>Toppings:</strong> {{ $order->toppings }} <br>

                        @if ($order->note != '')
                            <strong>Notes:</strong> {{ $order->note }}
                        @endif

                    </div>

                    {{-- <a class="btn btn-primary" href="{{ route('user.orders') }}">Back to Orders</a> --}}

                </div> <!-- end panel-body -->
            </div> <!-- end panel -->
        </div>
    </div>
</div>
@endsection