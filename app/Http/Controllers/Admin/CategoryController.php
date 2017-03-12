<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Parameter_group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends AdminController
{
    //

    public function CreateMenu( $parid, $menu, $level ) {

        $output = array();

        //return dd(url()->current());

        $action= url()->current();

        $uri_segments = explode('/', $action);
        $count=count($uri_segments);
        foreach( $menu as $item => $data ) {

            if ($data->parent_id == $parid) {
                $uri='';
                $output[ $data->id ] = $data;
                for($i=0; $i<=$level; $i++) {
                    if($i < $count) {
                        $request = new Request;
                        $uri.="/".$request->segment($i+1);
                    }
                    if($uri == $data->link ) {
                        $output[ $data->id ]->activeClass = 'active';
                        $output[ $data->id ]->inClass = 'in';
                    }
                    else {
                        $output[ $data->id ]->activeClass = '';
                        $output[ $data->id ]->inClass = '';
                    }
                    $output[ $data->id ]->level = $level+2;
                }
                $output[ $data->id ]->submenu = self::CreateMenu( $data->id, $menu, $level+1 );
            }

        }
        return $output;

    }


    public function index() {
        $parGrp = $this->parameterGroups;
        //$categories = Category::whereNull('parent_id')->get()->toArray();
        $categories = Category::get();
        $menu=$this->CreateMenu(0,$categories,0);
//return dd($menu);
        return view('admin.categories.index')->with(compact('menu','parGrp'));
    }

    public function addCategory($parent_id='') {

        if (!empty($parent_id))
            $parent = Category::findOrFail($parent_id);
        $parGrp = $this->parameterGroups;
        //$categories = Category::whereNull('parent_id')->get()->toArray();
        $categories = Category::get();
        $menu=$this->CreateMenu(0,$categories,0);

        return view('admin.categories.new')->with(compact('menu','parent','parGrp'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        if (empty(trim($input['name']))) {
            Session::flash('infomessage', 'У категории должно быть не пустое название!!!');
            return redirect('admin/category');
        }

        if (count(Category::where('name',$input['name'])->get())){
            Session::flash('infomessage', 'Категория с именем '.$input['name'].' уже существует!!!');
            return redirect('admin/category');
        }

        $published = 0;
        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;

        unset($input['parent']);
        if ($input['parent_id'] == '') $input['parent_id']= null;
//return dd($input);
        Category::create($input);
        Session::flash('infomessage','Изменения сохранены');

        //return dd($input);
        return redirect('admin/category');
    }
    public function destroy ($id)
    {
        $category = Category::findOrFail($id);
        $subcategory = $category->children;
        if (count($subcategory)){
            Session::flash('infomessage','Нельзя удалить категорию, у которой есть подкатегории!!!');
            return redirect('admin/category');
        }
        $articles = $category->articles;
        if (count($articles)){
            Session::flash('infomessage','Нельзя удалить категорию, у которой есть товары!!!');
            return redirect('admin/category');
        }
        if($category->delete())
            Session::flash('infomessage',$category->name.' - удалена из базы');
        return redirect('admin/category');
    }

    public function edit($id)
    {

        $image = $this->getOriginalImage('categories',$id,'intro1');
        $files['intro1'] = $image['url'];

        $category = Category::FindOrFail($id);
        $parGrp = $this->parameterGroups;
        $categories = Category::get();
        $menu=$this->CreateMenu(0,$categories,0);

        $parameterGroups = Parameter_group::select('name','id')->get()->pluck('name','id')->toArray();

        $checkedParameters = DB::table('category_parameter_group')->select('parameter_group_id')->where('category_id','=', $id)->get()->pluck('parameter_group_id')->toArray();

        return view('admin.categories.edit')->with(compact('menu','category','parGrp','files','parameterGroups','checkedParameters'));
    }

    public function update(Request $request, $id)
    {

        //return dd($request);


        $input = $request->all();
        $published = 0;
        DB::table('category_parameter_group')->where('category_id', '=', $id)->delete();
        if (isset($request->parameter_groups)){

            foreach ($request->parameter_groups as $key=>$group){
                DB::table('category_parameter_group')->insert(['category_id' => $id, 'parameter_group_id' => $key]);
            }
        }

        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;

        if(Category::find($id)->update($input))
            Session::flash('infomessage','Изменения сохранены');

        return redirect('admin/category');
    }

    public function storeMedia(Request $request,$id,$type='')
    {
        $this->saveOriginalImage($request->file('file')->getClientOriginalName(),$request->file('file'),'categories',$id,$type);
        return;
    }
}
