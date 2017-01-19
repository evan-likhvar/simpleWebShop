<?php

namespace App\Http\Controllers\Admin;

use App\orderHeader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends AdminController
{
    //
    public function index(Request $request) {

        $parGrp = $this->parameterGroups;

        $ordered = 'id';
        $filter = '';
        $order = 'desc';

        if (isset($request->sort)) {$ordered = $request->sort;}
        if ( isset($request->filter) && strlen($request->filter)>0) {$filter = $request->filter; }
        if ( isset($request->order) && strlen($request->order)>0) $order = $request->order;

        $orders = orderHeader::paginate(20);

        return view('admin.orders.index')->with(compact('orders','parGrp'));
    }

    public function edit($order) {

        $parGrp = $this->parameterGroups;
        $orderHeader = orderHeader::findOrFail($order);

        //return dd($orderHeader->orderRows);


        return view('admin.orders.edit')->with(compact('orderHeader','parGrp'));

    }

    public function update($order) {

        $parGrp = $this->parameterGroups;
        $orderHeader = orderHeader::findOrFail($order);

        //return dd($orderHeader->orderRows);


        return view('admin.orders.edit')->with(compact('orderHeader','parGrp'));

    }
}
