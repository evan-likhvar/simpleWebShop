<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Parameter_group;
use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArticleController extends AdminController
{
    //
    public function index(Request $request) {

        //return dd($request->all());

        $parGrp = $this->parameterGroups;

        $ordered = 'id';
        $filter = 0;
        $order = 'desc';

        if (isset($request->sort)) {$ordered = $request->sort;}

        if ( isset($request->order) && strlen($request->order)>0) $order = $request->order;


        if ( isset($request->filter) && $request->filter!=0  ) {
            $filter = $request->filter;
            $articles = Article::where('category_id','=', $request->filter)->orderBy($ordered,$order)->paginate(20);
        } else {
            $filter = 0;
            $articles = Article::orderBy($ordered,$order)->paginate(20);
        }

        //$articles = Article::where('name','LIKE', $filter. '%')->orderBy($ordered,$order)->paginate(20);
        //$articles = Article::orderBy($ordered,$order)->paginate(20);


        $categories = Category::select('name','id')->get()->pluck('name','id')->toArray();

        return view('admin.articles.index')->with(compact('articles','parGrp','categories'));
    }

    public function edit($id)
    {

        $image = $this->getOriginalImage('articles',$id,'intro1');
        $files['intro1'] = $image['url'];
        $image = $this->getOriginalImage('articles',$id,'intro2');
        $files['intro2'] = $image['url'];
        $image = $this->getOriginalImage('articles',$id,'intro3');
        $files['intro3'] = $image['url'];
        $image = $this->getOriginalImage('articles',$id,'intro4');
        $files['intro4'] = $image['url'];
        $image = $this->getFiles('articles',$id,'files');
        $files['files'] = $image;

        $parGrp = $this->parameterGroups;

        $article = Article::FindOrFail($id);

        $parentCategories = DB::table('categories')
            ->select('parent_id')
            ->where('parent_id','>',0)
            ->distinct()->get()->pluck('parent_id')->toarray();

        $categories = Category::select('name','id')->whereNotIN('id',$parentCategories)->get()->pluck('name','id')->toArray();

        $_parameterGroups = DB::table('getParameterGroupForArticle')->select('parametrDroup_id')->where('article_id','=', $id)->get()->pluck('parametrDroup_id')->toArray();
        $parameterGroups = Parameter_group::whereIn('id',$_parameterGroups)->get();

        $checkedParameters = DB::table('article_parameter')->select('parameter_id')->where('article_id','=', $id)->get()->pluck('parameter_id')->toArray();

        $vendors = Vendor::select('name','id')->get()->pluck('name','id')->toArray();

        return view('admin.articles.edit')->with(compact('article','parGrp','categories','vendors','files','parameterGroups','checkedParameters'));
    }

    public function create()
    {
        $parGrp = $this->parameterGroups;

        $parentCategories = DB::table('categories')
            ->select('parent_id')
            ->where('parent_id','>',0)
            ->distinct()->get()->pluck('parent_id')->toarray();

        $categories = Category::select('name','id')->whereNotIN('id',$parentCategories)->orderBy('name')->get()->pluck('name','id')->toArray();

        $vendors = Vendor::select('name','id')->get()->pluck('name','id')->toArray();
        return view('admin.articles.new')->with(compact('parGrp','categories','vendors'));
    }

    public function store(Request $request)
    {

        $parGrp = $this->parameterGroups;
        $input = $request->all();
        if (empty(trim($input['name']))) {
            Session::flash('infomessage', 'У товара должно быть не пустое название!!!');
            return redirect('admin/article/create');
        }
        if (empty(trim($input['category_id']))) {
            Session::flash('infomessage', 'Выберете категорию!!!');
            return redirect('admin/article/create');
        }
        if (empty(trim($input['vendor_id']))) {
            Session::flash('infomessage', 'Выберете производителя!!!');
            return redirect('admin/article/create');
        }
        if (count(Article::where('name',$input['name'])->get())){
            Session::flash('infomessage', 'Товар с именем '.$input['name'].' уже существует!!!');
            return redirect('admin/article/create');
        }



        $article = Article::create($input);
        Session::flash('infomessage','Изменения сохранены');

        $image = $this->getOriginalImage('articles',$article->id,'intro1');
        $files['intro1'] = $image['url'];

        $categories = Category::select('name','id')->get()->pluck('name','id')->toArray();
        $vendors = Vendor::select('name','id')->get()->pluck('name','id')->toArray();

        $_parameterGroups = DB::table('getParameterGroupForArticle')->select('parametrDroup_id')->where('article_id','=', $article->id)->get()->pluck('parametrDroup_id')->toArray();

        $parameterGroups = Parameter_group::whereIn('id',$_parameterGroups)->get();
        $checkedParameters = DB::table('article_parameter')->select('parameter_id')->where('article_id','=', $article->id)->get()->pluck('parameter_id')->toArray();

        return view('admin.articles.edit')->with(compact('article','parGrp','categories','vendors','files','parameterGroups','checkedParameters'));

    }
    public function update(Request $request, $id)
    {

        $input = $request->all();
        $published = 0;
        $avaliable = 0;

    //    return dd($input);

        if (empty(trim($input['priceGRN']))) {
            $input['priceGRN']=0;
        }
        if (empty(trim($input['priceYE']))) {
            $input['priceYE']=0;
        }

        if (empty(trim($input['name']))) {
            Session::flash('infomessage', 'У товара должно быть не пустое название!!!');
            return redirect('admin/article/'.$id.'/edit');
        }
        if (empty(trim($input['category_id']))) {
            Session::flash('infomessage', 'Выберете категорию!!!');
            return redirect('admin/article/'.$id.'/edit');
        }
        if (empty(trim($input['vendor_id']))) {
            Session::flash('infomessage', 'Выберете производителя!!!');
            return redirect('admin/article/'.$id.'/edit');
        }
        if ($input['priceYE']<0 || $input['priceGRN']<0) {
            Session::flash('infomessage', 'Ошибка при вводе цены!!!');
            return redirect('admin/article/'.$id.'/edit');
        }
        if ($input['priceYE']+$input['priceGRN']==0) {
            Session::flash('infomessage', 'Укажите хотя-бы одну цену!!!');
            return redirect('admin/article/'.$id.'/edit');
        }

        $article = Article::find($id);


        if (($article->category_id - $input['category_id']) == 0) {

            //находим все возможные группы параметров для текущей категории
            $categoryGroupParameters = DB::table('category_parameter_group')
                ->select('parameter_group_id')
                ->where('category_id', $input['category_id'])
                ->distinct()->get()->pluck('parameter_group_id')->toarray();
            //находим группы параметров, которые использованы
            if (isset($request->parameter))
                $keys = array_keys($input['parameter']);
            $selectedGroupParameters = array();
            if (!empty($keys))
                $selectedGroupParameters = DB::table('parameters')
                    ->select('parameter_group_id')
                    ->whereIn('id', $keys)
                    ->distinct()->get()->pluck('parameter_group_id')->toarray();


            if (count($categoryGroupParameters) != count($selectedGroupParameters)) {
                Session::flash('infomessage', 'Указаны не все параметры товара!!!');
                return redirect('admin/article/' . $id . '/edit');
            }

            if (isset($request->parameter)) {
                DB::table('article_parameter')->where('article_id', '=', $id)->delete();
                foreach ($request->parameter as $key => $parameter) {
                    DB::table('article_parameter')->insert(['article_id' => $id, 'parameter_id' => $key]);
                }
            }
        }
        else {
            DB::table('article_parameter')->where('article_id', '=', $id)->delete();
        }

        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;
        if (isset($request->avaliable)) if ($request->avaliable == 'on') $avaliable = 1;
        $input['avaliable'] = $avaliable;


        $article = Article::find($id);

        //return dd($article,$input);

        if($article->update($input))
            Session::flash('infomessage','Изменения сохранены');



        return redirect()->to(url("admin/article/$id/edit"));


        //return redirect('admin/article');
    }
    public function destroy ($id)
    {

        $article = Article::findOrFail($id);

        if($article->delete())
            Session::flash('infomessage',$article->name.' - deleted');

        return redirect()->back();
        //return redirect('admin/article');
    }

    public function copy($oldId)
    {

        $parGrp = $this->parameterGroups;

        $oldArticle = Article::FindOrFail($oldId);
        $article = $oldArticle->replicate();
        $article->save();

        $id = $article->id;




        $this->copyOriginalImageWithResizing('articles',$oldId,$id,'intro1');
        $this->copyOriginalImageWithResizing('articles',$oldId,$id,'intro2');
        $this->copyOriginalImageWithResizing('articles',$oldId,$id,'intro3');
        $this->copyOriginalImageWithResizing('articles',$oldId,$id,'intro4');
        $this->copyOriginalImageWithResizing('articles',$oldId,$id,'files');
        $image = $this->getOriginalImage('articles',$id,'intro1');
        $files['intro1'] = $image['url'];
        $image = $this->getOriginalImage('articles',$id,'intro2');
        $files['intro2'] = $image['url'];
        $image = $this->getOriginalImage('articles',$id,'intro3');
        $files['intro3'] = $image['url'];
        $image = $this->getOriginalImage('articles',$id,'intro4');
        $files['intro4'] = $image['url'];
        $image = $this->getFiles('articles',$id,'files');
        $files['files'] = $image;




        $categories = Category::select('name','id')->get()->pluck('name','id')->toArray();

        $_parameterGroups = DB::table('getParameterGroupForArticle')->select('parametrDroup_id')->where('article_id','=', $id)->get()->pluck('parametrDroup_id')->toArray();
        $parameterGroups = Parameter_group::whereIn('id',$_parameterGroups)->get();


        $checkedParameters = DB::table('article_parameter')->select('parameter_id')->where('article_id','=', $oldId)->get()->pluck('parameter_id')->toArray();
        $vendors = Vendor::select('name','id')->get()->pluck('name','id')->toArray();

        return view('admin.articles.edit')->with(compact('article','parGrp','categories','vendors','files','parameterGroups','checkedParameters'));
    }

    public function storeMedia(Request $request,$id,$type)
    {

        $this->saveOriginalImage($request->file('file')->getClientOriginalName(),$request->file('file'),'articles',$id,$type);

        return;
    }

    public function deleteArticleFile($file)
    {

        $this->deleteFile(str_replace(['~','!'],['/','.'],$file));

        return redirect()->back();
    }

    public function recalculatePrices(Request $request){

        $input = $request->all();
        if(isset($input['course'])&&$input['course']>0){
            Article::recalculatePrices($input['course']);
        }

        return redirect('admin/article');

    }


}
