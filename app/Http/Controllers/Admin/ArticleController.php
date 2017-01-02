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

        $parGrp = $this->parameterGroups;

        $ordered = 'id';
        $filter = '';
        $order = 'desc';

        if (isset($request->sort)) {$ordered = $request->sort;}
        if ( isset($request->filter) && strlen($request->filter)>0) {$filter = $request->filter; }
        if ( isset($request->order) && strlen($request->order)>0) $order = $request->order;

        $articles = Article::where('name','LIKE', $filter. '%')->orderBy($ordered,$order)->paginate(15);


        return view('admin.articles.index')->with(compact('articles','parGrp'));
    }
    public function edit($id)
    {
        $mediaPath = 'images/articles/'.$id;      //базовый путь к каталогу с медиа
        $original = '/intro1/original';         //суфикс к каталогам с оригиналами картинок
        $files['intro1'] = Storage::files($mediaPath.$original); // собрали линки на картинки в тексте статьи

        $parGrp = $this->parameterGroups;

        $article = Article::FindOrFail($id);
        $categories = Category::select('name','id')->get()->pluck('name','id')->toArray();

        $_parameterGroups = DB::table('getParameterGroupForArticle')->select('parametrDroup_id')->where('article_id','=', $id)->get()->pluck('parametrDroup_id')->toArray();
        $parameterGroups = Parameter_group::whereIn('id',$_parameterGroups)->get();

        $checkedParameters = DB::table('article_parameter')->select('parameter_id')->where('article_id','=', $id)->get()->pluck('parameter_id')->toArray();

        $vendors = Vendor::select('name','id')->get()->pluck('name','id')->toArray();


        return view('admin.articles.edit')->with(compact('article','parGrp','categories','vendors','files','parameterGroups','checkedParameters'));
    }

    public function create()
    {
        $parGrp = $this->parameterGroups;
        $categories = Category::select('name','id')->get()->pluck('name','id')->toArray();
        $vendors = Vendor::select('name','id')->get()->pluck('name','id')->toArray();
        return view('admin.articles.new')->with(compact('parGrp','categories','vendors'));
    }
    public function store(Request $request)
    {


        $parGrp = $this->parameterGroups;
        $input = $request->all();

        $article = Article::create($input);
        Session::flash('infomessage','Изменения сохранены');
        $mediaPath = 'images/articles/'.$article->id;      //базовый путь к каталогу с медиа
        $original = '/intro1/original';         //суфикс к каталогам с оригиналами картинок
        $categories = Category::select('name','id')->get()->pluck('name','id')->toArray();
        $vendors = Vendor::select('name','id')->get()->pluck('name','id')->toArray();
        $files['intro1'] = Storage::files($mediaPath.$original); // собрали линки на картинки в тексте статьи
        $_parameterGroups = DB::table('getParameterGroupForArticle')->select('parametrDroup_id')->where('article_id','=', $article->id)->get()->pluck('parametrDroup_id')->toArray();

        $parameterGroups = Parameter_group::whereIn('id',$_parameterGroups)->get();
        $checkedParameters = DB::table('article_parameter')->select('parameter_id')->where('article_id','=', $article->id)->get()->pluck('parameter_id')->toArray();

       // return dd($input);
        return view('admin.articles.edit')->with(compact('article','parGrp','categories','vendors','files','parameterGroups','checkedParameters'));

    }
    public function update(Request $request, $id)
    {

        //return dd($request);


        $input = $request->all();
        $published = 0;

        if (isset($request->parameter)){
            DB::table('article_parameter')->where('article_id', '=', $id)->delete();
            foreach ($request->parameter as $key=>$parameter){
                DB::table('article_parameter')->insert(['article_id' => $id, 'parameter_id' => $key]);
            }
        }

        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;

        if(Article::find($id)->update($input))
            Session::flash('infomessage','Изменения сохранены');

        return redirect('admin/article');
    }

    public function storeMedia(Request $request,$id,$type='')
    {

        $path = 'images' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR;  //   images/article/19680/

        $OriginalName = $request->file('file')->getClientOriginalName();

        $patterns = array();
        $patterns[0] = '/ /';
        $patterns[1] = '/&/';
        $replacement = '_';
        $OriginalName = preg_replace($patterns, $replacement, $OriginalName);

        $pathOriginal = $path . $type . DIRECTORY_SEPARATOR . 'original' . DIRECTORY_SEPARATOR; //   images/article/19680/original/

        Storage::deleteDirectory($pathOriginal);

        $sFile = Storage::putFileAs($pathOriginal, $request->file('file'), $OriginalName);

        $md5name = md5("Image".$id);

        $inp = base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$pathOriginal.$OriginalName;
        $out = base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$path.$type.DIRECTORY_SEPARATOR.$md5name;//.'jpg';
        $img = Image::make($inp)->resize(110, 82)->save($out.'_XS.jpg');
        $img = Image::make($inp)->resize(230, 171)->save($out.'_S.jpg');
        $img = Image::make($inp)->resize(320, null, function ($constraint) {$constraint->aspectRatio();})->save($out.'_M.jpg');
        $img = Image::make($inp)->resize(640, null, function ($constraint) {$constraint->aspectRatio();})->save($out.'_L.jpg');
    }

}
