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
        $action= Route::current()->getUri();
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

        return view('admin.categories.index')->with(compact('menu','parGrp'));
    }

    public function addCategory($parent_id) {

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
        $published = 0;
        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;

        unset($input['parent']);

        Category::create($input);
        Session::flash('infomessage','Изменения сохранены');

        //return dd($input);
        return redirect('admin/category');
    }
    public function destroy ($id)
    {
        $category = Category::find($id);
        $subcategory = $category->children;
        if (count($subcategory)){
            Session::flash('infomessage','Нельзя удалить производителя, у которой есть зарегистрированные товары!!!');
            return redirect('admin/category');
        }
        if($category->delete())
            Session::flash('infomessage',$category->name.' - deleted');
        return redirect('admin/category');
    }

    public function edit($id)
    {
        $mediaPath = 'images/categories/'.$id;      //базовый путь к каталогу с медиа
        $original = '/intro1/original';         //суфикс к каталогам с оригиналами картинок
        $files['intro1'] = Storage::files($mediaPath.$original); // собрали линки на картинки в тексте статьи
        $category = Category::FindOrFail($id);
        $parGrp = $this->parameterGroups;
        $categories = Category::get();
        $menu=$this->CreateMenu(0,$categories,0);

        $parameterGroups = Parameter_group::select('name','id')->get()->pluck('name','id')->toArray();

        $checkedParameters = DB::table('category_parameter_group')->select('parameter_group_id')->where('category_id','=', $id)->get()->pluck('parameter_group_id')->toArray();

        //return dd($checkedParameters);

        return view('admin.categories.edit')->with(compact('menu','category','parGrp','files','parameterGroups','checkedParameters'));
    }

    public function update(Request $request, $id)
    {

        //return dd($request);


        $input = $request->all();
        $published = 0;

        if (isset($request->parameter_groups)){
            DB::table('category_parameter_group')->where('category_id', '=', $id)->delete();
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

        $path = 'images' . DIRECTORY_SEPARATOR . 'categories' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR;  //   images/article/19680/

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
