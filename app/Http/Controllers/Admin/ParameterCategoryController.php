<?php

namespace App\Http\Controllers\Admin;

use App\Parameter_group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ParameterCategoryController extends AdminController
{
    //
    public function index() {
        $parGrp = $this->parameterGroups;
        $parameterGroups = Parameter_group::all();
        return view('admin.ParameterGroups.index')->with(compact('parameterGroups','parGrp'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Parameter_group::create($input);
        return redirect('admin/parameter-category');
    }

    public function edit($id)
    {
        $parGrp = $this->parameterGroups;
        $parameter_group = Parameter_group::FindOrFail($id);
        return view('admin.ParameterGroups.edit')->with(compact('parameter_group','parGrp'));
    }

    public function destroy ($id)
    {
        $parameter_group = Parameter_group::find($id);
        $parameters = $parameter_group->Parameters;
        if (count($parameters)){
            Session::flash('infomessage','Нельзя удалить класс, у которой есть параметры!!!');
            return redirect('admin/parameter-category');
        }
        if($parameter_group->delete())
            Session::flash('infomessage',$parameter_group->name.' - deleted');
        return redirect('admin/parameter-category');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $published = 0;
        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;

        if(Parameter_group::find($id)->update($input))
            Session::flash('infomessage','Изменения сохранены');

        return redirect('admin/parameter-category');
    }
}
