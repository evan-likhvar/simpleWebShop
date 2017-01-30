<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends FrontController
{
    public function show($categoryId){

        $topActive = $this->getTopActiveMenu();
        $activeSubId = $this->getSubActiveMenu();
        $countCartItems = $this->getCountCartItems();
        $cartItemsDescription = $this->getCartItems();
        $mainMenu = Category::whereNull('parent_id')->get();
        $category = Category::findOrFail($categoryId);
        $homeArticles = Article::limit(8)->get();

        $checkedParameters = array();
        $checkedParameters = Session::get($categoryId.':parameters');

        if (empty($checkedParameters)) $unCheckAll = false; else $unCheckAll = true;



        $filter = $this->getParametersFilter($checkedParameters,$categoryId);



        $orderBy = 'по популярности';
        $order = Session::get('order');
        if ($order == 'asc') $orderBy = 'по возрастанию цены';
        if ($order == 'desc') $orderBy = 'по убыванию цены';
        if ($order == 'popular') $orderBy = 'по популярности';

        if($order == 'asc' || $order == 'desc')
            $articles = Article::where('category_id','=', $category->id)->whereIn('id', $filter)->orderby('priceGRN',$order)->paginate(8);
        elseif ($order == 'popular')
            $articles = Article::where('category_id','=', $category->id)->whereIn('id', $filter)->orderby('order',$order)->paginate(8);
        else $articles = Article::where('category_id','=', $category->id)->whereIn('id', $filter)->paginate(8);


        if (count($category->Children)){
            return view('layouts.categories')->with(compact('activeSubId','topActive','category','mainMenu','countCartItems','homeArticles','cartItemsDescription'));
        } else {
            return view('layouts.categoryArticles')->with(compact('activeSubId','topActive','unCheckAll','articles','orderBy','checkedParameters','category','mainMenu','countCartItems','homeArticles','cartItemsDescription'));
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

        return redirect()->back();
    }

    protected function getParametersFilter($checkedParameters,$categoryId){


        $keys = array();
        if(!empty($checkedParameters))
        $keys = array_keys($checkedParameters);

        //находим все возможные группы параметров для текущей категории
        $categoryGroupParameters = DB::table('category_parameter_group')
            ->select('parameter_group_id')
            ->where('category_id', $categoryId)
            ->distinct()->get()->pluck('parameter_group_id')->toarray();

        if (empty($categoryGroupParameters))
            // у категории нет параметров!!
        {
            $articleArray = Article::where('category_id','=',$categoryId)->get()->toArray();
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
