<?php

namespace App\Http\Controllers\Admin;

use App\orderHeader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderController extends AdminController
{
    //
    protected $orderStatus = ['0'=>'Новый','1'=>'Подтвержденный','2'=>'Выполняемый','3'=>'Завершенный','4'=>'Отмененный'];
    protected $paymentName = ['1'=>'Наличные','2'=>'Безналичные'];
    protected $shipmentName = ['1'=>'к подъезду','2'=>'с установкой','3'=>'Самовывоз'];

    public function index(Request $request) {

        $parGrp = $this->parameterGroups;

        $ordered = 'id';
        $filter = '';
        $order = 'desc';

        if (isset($request->sort)) {$ordered = $request->sort;}
        if ( isset($request->filter) && strlen($request->filter)>0) {$filter = $request->filter; }
        if ( isset($request->order) && strlen($request->order)>0) $order = $request->order;

        $orders = orderHeader::orderBy($ordered,$order)->paginate(20);
//return dd($orders);

        return view('admin.orders.index')->with(compact('orders','parGrp'));
    }

    public function edit($order) {

        $parGrp = $this->parameterGroups;
        $orderHeader = orderHeader::findOrFail($order);

        $orderStatus = $this->orderStatus;
        $paymentName = $this->paymentName;
        $shipmentName = $this->shipmentName;
        return view('admin.orders.edit')->with(compact('orderHeader','parGrp','orderStatus','paymentName','shipmentName'));

    }

    public function update(Request $request, $order) {

        $input = $request->all();
        $parGrp = $this->parameterGroups;
        $orderHeader = orderHeader::findOrFail($order);

        $orderHeader->update($input);

        $orderStatus = $this->orderStatus;
        $paymentName = $this->paymentName;
        $shipmentName = $this->shipmentName;

        return view('admin.orders.edit')->with(compact('orderHeader','parGrp','orderStatus','paymentName','shipmentName'));

    }

    public function destroy ($id)
    {
        $orderHeader = orderHeader::findOrFail($id);

        DB::table('order_rows')->where('order_header_id', '=', $orderHeader->id)->delete();

        if($orderHeader->delete())
            Session::flash('infomessage',$orderHeader->id.' - удален из базы');

        return redirect('admin/order');
    }
}
