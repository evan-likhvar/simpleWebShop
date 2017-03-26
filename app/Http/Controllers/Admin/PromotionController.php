<?php

namespace App\Http\Controllers\Admin;

use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PromotionController extends AdminController
{
    public function createNewPromotion()
    {
        $parGrp = $this->parameterGroups;
        return view('admin.Promotion.new')->with(compact('parGrp'));
    }

    public function PromotionStore(Request $request)
    {
        $parGrp = $this->parameterGroups;
        $input = $request->all();
        $promotion = Promotion::create($input);
        Session::flash('infomessage','Новая актиция сохранена id- '.$promotion->id);

        $image = $this->getOriginalImage('promotion',$promotion->id,'intro1');
        $files['intro1'] = $image['url'];

        //return dd($promotion);

        return view('admin.Promotion.edit')->with(compact('parGrp','promotion','files'));
    }

    public function PromotionUpdate(Request $request, $id){
        $input = $request->all();
        $published = 0;
        $promotion = Promotion::findOrFail($id);
        if (isset($request->is_published)) if ($request->is_published == 'on') $published = 1;
        $input['is_published'] = $published;
        if($promotion->update($input))
            Session::flash('infomessage','Изменения сохранены');
        return redirect()->to(url("admin/promotion/$id/edit"));
    }

    public function storeMedia(Request $request,$id,$type='')
    {
        $this->saveOriginalImage($request->file('file')->getClientOriginalName(),$request->file('file'),'promotion',$id,$type);
        return;
    }

    public function editPromotion($id){
        $parGrp = $this->parameterGroups;
        $promotion = Promotion::FindOrFail($id);
        $image = $this->getOriginalImage('promotion',$promotion->id,'intro1');
        $files['intro1'] = $image['url'];

        return view('admin.Promotion.edit')->with(compact('parGrp','promotion','files'));
    }

    public function PromotionIndex(Request $request) {
        $parGrp = $this->parameterGroups;

        $ordered = 'id';
        $filter = 0;
        $order = 'desc';

        if (isset($request->sort)) {$ordered = $request->sort;}
        if ( isset($request->order) && strlen($request->order)>0) $order = $request->order;
        if ( isset($request->filter) && $request->filter!=0  ) {
            $filter = $request->filter;
            $promotions = Promotion::where('category_id','=', $request->filter)->orderBy($ordered,$order)->paginate(20);
        } else {
            $filter = 0;
            $promotions = Promotion::orderBy($ordered,$order)->paginate(20);
        }

        return view('admin.Promotion.index')->with(compact('promotions','parGrp'));
    }

    public function PromotionDestroy($id){
        $promotion = Promotion::findOrFail($id);

        if($promotion->delete())
            Session::flash('infomessage',$promotion->name.' - deleted');

        return redirect()->back();
    }
}
