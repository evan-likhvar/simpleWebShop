<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\papercategory;
use App\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends FrontController
{
    public function show($categoryId){

        $category = Category::findOrFail($categoryId);


        $siteMenu = $this->getSiteMenu();
        $cartInfo = $this->getCartInfo();
        $siteParameters = $this->getSiteParameters();
        $homeArticles = $this->getPromotions();

        $checkedParameters = array();
        $checkedParameters = Session::get(substr($categoryId,0,mb_strpos($categoryId,'-')).':parameters');

        if (empty($checkedParameters)) $unCheckAll = false; else $unCheckAll = true;

        //return dd(substr($categoryId,0,mb_strpos($categoryId,'-')));

        $filter = $this->getParametersFilter($checkedParameters,$categoryId);

        $orderBy = 'по популярности';
        $order = Session::get('order');
        if ($order == 'asc') $orderBy = 'по возрастанию цены';
        if ($order == 'desc') $orderBy = 'по убыванию цены';
        if ($order == 'popular') $orderBy = 'по популярности';

        $artToPaginate=Article::where('category_id','=', $category->id)->whereIn('id', $filter)->get();

        $paginate = 8;
        if (count($artToPaginate)>23)
            $paginate = 16;
        $layout = "list";
        if ($paginate == 16 || $category->id == 15)
            $layout = "plate";

        //return dd($paginate);

        if($order == 'asc' || $order == 'desc')
            $articles = Article::where('category_id','=', $category->id)->whereIn('id', $filter)->orderby('priceGRN',$order)->paginate($paginate);
        elseif ($order == 'popular')
            $articles = Article::where('category_id','=', $category->id)->whereIn('id', $filter)->orderby('order','desc')->paginate($paginate);
        else
            $articles = Article::where('category_id','=', $category->id)->whereIn('id', $filter)->orderby('order','desc')->paginate($paginate);

        if (count($category->Children)){
            return view('layouts.categories')->with(compact('layout','category','homeArticles','siteMenu','cartInfo','siteParameters'));
        } else {
            return view('layouts.categoryArticles')->with(compact('layout','unCheckAll','articles','orderBy','checkedParameters','category','homeArticles','siteMenu','cartInfo','siteParameters'));
        }
    }

    protected function setArticlesOrder($order){

        Session::put('order', $order);

        return redirect()->back();
    }

    protected function  setParameters (Request $request) {

        $input = $request->all();

        $categoryId = $input['category'];

        unset($input['category']);
        unset($input['_token']);


        Session::put($categoryId.':parameters', $input);

        //$data = $request->session()->all();

        //return dd($data);

        return redirect()->back();
    }
    protected function  eraseParameters (Request $request) {

        Session::forget($request['category'].':parameters');

        return redirect()->back();
    }
    protected function  setParametersJSON (Request $request) {

        $input = $request->all();

        if (isset($input)) {
            if (isset($input['CheckedParameters'])) {
                foreach ($input['CheckedParameters'] as $value) {
                    $parameters[$value] =  $value;
                }
            }
        }

        if (isset($parameters)) {
            Session::put($input['CategoryID'].':parameters', $parameters);
        }
        else Session::forget($input['CategoryID'].':parameters');

        //Session::put('testparameters1', ['11'=>$input['CategoryID']]);

        redirect()->back();
    }

    protected function getParametersFilter($checkedParameters,$categoryId){


        $keys = array();
        if(!empty($checkedParameters))
        $keys = array_keys($checkedParameters);
//return dd($checkedParameters);
        //находим все возможные группы параметров для текущей категории
        $categoryGroupParameters = DB::table('category_parameter_group')
            ->select('parameter_group_id')
            ->where('category_id', $categoryId)
            ->distinct()->get()->pluck('parameter_group_id')->toarray();

        if (empty($categoryGroupParameters))
            // у категории нет параметров!!
        {
            $articleArray = Article::where('category_id','=',$categoryId)->get()->pluck('id')->toArray();
            return  $articleArray;
        }

        //находим группы параметров, которые задействованы в фильте
        if(!empty($checkedParameters))
        $selectedGroupParameters = DB::table('parameters')
            ->select('parameter_group_id')
            ->whereIn('id', $keys)
            ->distinct()->get()->pluck('parameter_group_id')->toarray();
        else
            $selectedGroupParameters = $categoryGroupParameters;


        //дописываем НЕ задействованные группы всеми возможными параметрами
        //if(!empty($checkedParameters))
        $addKeys = array();
        foreach ($categoryGroupParameters as $GroupParameter){

            if (empty($checkedParameters) || array_search($GroupParameter,$selectedGroupParameters) === false)
            {
                $addKeys = DB::table('parameters')
                    ->select('id')
                    ->where('parameter_group_id', $GroupParameter)
                    ->distinct()->get()->pluck('id')->toarray();
            }

        }

            $keys = array_merge($keys,$addKeys);



        //сортируем задействованные параметры по группах
        $parametersCollection = Parameter::select('id','parameter_group_id')->whereIn('id',$keys)->get()->groupBy('parameter_group_id')->toArray();

        foreach ($parametersCollection as $key=>$value){
            $keysArray[$key] = array_pluck($value,'id');
        }

        //находим полный лист товаров
        $articleArray = DB::table('article_parameter')
            ->select('article_id')
            ->whereIn('parameter_id', $keys)
            ->distinct()->get()->pluck('article_id')->toarray();

        //пересекаем полученные массивы параметров
        if (isset($keysArray)) {
            foreach ($keysArray as $lKeys) {

                $articleArrayFiltered = DB::table('article_parameter')
                    ->select('article_id')
                    ->whereIn('parameter_id', $lKeys)
                    ->distinct()->get()->pluck('article_id')->toarray();
                $articleArray = array_intersect($articleArray, $articleArrayFiltered);
            }
        }

        //         return dd($articleArray);

        return $articleArray;

    }
}
