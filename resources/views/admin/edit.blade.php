@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Order Status</div>

                <div class="panel-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form class="form-horizontal" id="update-order-status-form" method="post" action="{{ route('admin.order.update', $order) }}">

                        {{ csrf_field() }}
                        {!! method_field('patch') !!}

                        <div class="form-group m-b-lg">
                            <label class="control-label col-lg-3">Order ID</label>
                            <div class="col-lg-8">
                                 <div class="form-control">{{ $order->id }}</div>
                            </div> 
                        </div> 

                        <div class="form-group m-b-lg">
                            <label class="control-label col-lg-3">Customer</label>
                            <div class="col-lg-8">
                                 <div class="form-control">{{ $order->name }}</div>
                            </div> 
                        </div> 

                        <div class="form-group m-b-lg">
                            <label class="control-label col-lg-3">Size</label>
                            <div class="col-lg-8">
                                 <div class="form-control">{{ $order->size }}</div>
                            </div> 
                        </div> 

                        <div class="form-group m-b-lg">
                            <label class="control-label col-lg-3">Toppings</label>
                            <div class="col-lg-8">
                                 <div class="form-control">{{ $order->toppings }}</div>
                            </div> 
                        </div> 

                        <div class="form-group m-b-lg">
                            <label class="control-label col-lg-3">Notes</label>
                            <div class="col-lg-8">
                                 <div class="form-control">{{ $order->note }}</div>
                            </div> 
                        </div> 

                        <div class="form-group">
                            <label for="status_id" class="control-label col-lg-3">Status</label>
                            <div class="controls col-lg-8">

                                <select name="status" id="status" class="form-control">
                                    @foreach ($statuses as $status)
                                        @if ((old("status", $currentStatus) == $status->id))
                                            <option value="{{ $status->id}}" selected>{{ $status->name }}</option>
                                        @else
                                            <option value="{{ $status->id}}">{{ $status->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-lg-3"></div>
                            <div class="controls col-lg-8">
                                <div class="form-actions">
                                    <button type="submit" id="update-order" class="btn btn-success">Update Status</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection