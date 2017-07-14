<?php

namespace App\Http\Controllers\Admin;

use App\promotin_type;
use App\Promotion;
use App\Promotion_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PromotionController extends AdminController
{
    public function createNewPromotion()
    {
        $parGrp = $this->parameterGroups;
        $promotion_type = Promotion_type::select('promotion_name','id')->get()->pluck('promotion_name','id')->toArray();;

        return view('admin.Promotion.new')->with(compact('parGrp','promotion_type'));
    }

    public function PromotionStore(Request $request)
    {
        $parGrp = $this->parameterGroups;
        $input = $request->all();
        $promotion = Promotion::create($input);
        Session::flash('infomessage','Новая актиция сохранена id- '.$promotion->id);

        $image = $this->getOriginalImage('promotion',$promotion->id,'intro1');
        $files['intro1'] = $image['url'];

        $promotion_type = Promotion_type::select('promotion_name','id')->get()->pluck('promotion_name','id')->toArray();;


        return view('admin.Promotion.edit')->with(compact('parGrp','promotion','files','promotion_type'));
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
        $promotion_type = Promotion_type::select('promotion_name','id')->get()->pluck('promotion_name','id')->toArray();;

        //dd($promotion_type);


        return view('admin.Promotion.edit')->with(compact('parGrp','promotion','files','promotion_type'));
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

    public function indexPromotionArticle(Promotion $promotion) {
        $parGrp = $this->parameterGroups;
        $articles = $promotion->Articles;

        return view('admin.Promotion.indexPromotionArticles')->with(compact('promotion','articles','parGrp'));
    }

    public function PromotionArticleDestroy(Promotion $promotion, int $article){


        $promotion->Articles()->detach([$article]);

       // dd($promotion,$article);

        return redirect()->back();
    }
}
