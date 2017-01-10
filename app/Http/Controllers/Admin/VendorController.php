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

        $image = $this->getOriginalImage('vendors',$id,'intro1');
        $files['intro1'] = $image['url'];

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
    public function storeMedia(Request $request,$id,$type)
    {

        $this->saveOriginalImage($request->file('file')->getClientOriginalName(),$request->file('file'),'vendors',$id,$type);
        return;
    }

}