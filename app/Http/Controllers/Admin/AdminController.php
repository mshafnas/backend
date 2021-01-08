<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderPizza;
use App\Status;
use App\Events\OrderStatusChanged;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // return view 
    public function index() {
        $orders = OrderPizza::latest()->get();
        
        return view('admin.index')->with('orders', $orders);
    }

    public function edit($id) {
        $order = OrderPizza::find($id);
        $statuses = Status::all();
        $currentStatus = $order->status_id;
        return view('admin.edit')->with(['order' => $order, 'statuses' => $statuses, 'currentStatus' => $currentStatus]);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'status' => 'required'
        ]);

        $order = OrderPizza::find($id);
        $order->status_id = $request->status;
        $order->save();

        event(new OrderStatusChanged($order));

        return back()->with('message', 'Order Status updated successfully!');
    }
}
