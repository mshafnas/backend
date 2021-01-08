@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Address</th>
                        <th>Size</th>
                        <th>Toppings</th>
                        <th>Note</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->size}}</td>
                                <td>{{$order->toppings}}</td>
                                <td>{{$order->note}}</td>
                                <td><a href="/admin/order/edit/{{$order->id}}" class="btn btn-primary">Check</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection