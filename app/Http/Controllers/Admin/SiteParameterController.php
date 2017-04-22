<?php

namespace App\Http\Controllers\Admin;

use App\SiteParameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SiteParameterController extends AdminController
{
    public function edit(){

        $parGrp = $this->parameterGroups;
        $parameter = json_decode(SiteParameter::first()->parameters,true);
//return dd($parameter);
        return view('admin.siteParameters.edit')->with(compact('parameter','parGrp'));
    }

    public function store(Request $request){

        $input = $request->all();
        unset($input['_method']);
        unset($input['_token']);

        $parameter = SiteParameter::first();
        $parameter->parameters = json_encode($input);
        $parameter->save();

        Session::flash('user_message', 'Изменения сохранены!');

        return redirect()->back();
    }
}
