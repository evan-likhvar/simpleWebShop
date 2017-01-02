<?php

namespace App\Http\Controllers\Admin;

use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class VendorController extends AdminController
{
    //
    public function index()
    {
        $vendors = Vendor::all();
        $parGrp = $this->parameterGroups;
        return view('admin.vendors.index')->with(compact('vendors','parGrp'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Vendor::create($input);
        return redirect('admin/vendor');
    }

    public function edit($id)
    {
        $mediaPath = 'images/vendors/'.$id;      //базовый путь к каталогу с медиа
        $original = '/intro1/original';         //суфикс к каталогам с оригиналами картинок
        $files['intro1'] = Storage::files($mediaPath.$original); // собрали линки на картинки в тексте статьи

        $vendor = Vendor::FindOrFail($id);
        $parGrp = $this->parameterGroups;
        return view('admin.vendors.edit')->with(compact('vendor','parGrp','files'));
    }

    public function destroy ($id)
    {
        $vendor = Vendor::find($id);
        $article = $vendor->Articles;
        if (count($article)){
            Session::flash('infomessage','Нельзя удалить производителя, у которой есть зарегистрированные товары!!!');
            return redirect('admin/vendor');
        }
        if($vendor->delete())
            Session::flash('infomessage',$vendor->name.' - deleted');
        return redirect('admin/vendor');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $published = 0;
        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;

        if(Vendor::find($id)->update($input))
            Session::flash('infomessage','Изменения сохранены');

        return redirect('admin/vendor');
    }
    public function storeMedia(Request $request,$id,$type='')
    {

        $path = 'images' . DIRECTORY_SEPARATOR . 'vendors' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR;  //   images/article/19680/

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