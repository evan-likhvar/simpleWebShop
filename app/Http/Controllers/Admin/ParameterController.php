<?php

namespace App\Http\Controllers\Admin;

use App\Parameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ParameterController extends AdminController
{
    //
    public function index($group) {
        $parGrp = $this->parameterGroups;
        $parameters = Parameter::where('parameter_group_id','=',$group)->get();
        return view('admin.parameters.index')->with(compact('parameters','parGrp','group'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $input['value'] = $input['name'];

        Parameter::create($input);
        return redirect('admin/parameter/group/'.$input['parameter_group_id'] );
    }
    public function edit($id)
    {
        $parGrp = $this->parameterGroups;
        $parameter = Parameter::FindOrFail($id);
        return view('admin.parameters.edit')->with(compact('parameter','parGrp'));
    }

    public function destroy ($id)
    {
        $parameter = Parameter::find($id);
        if($parameter->delete())
            Session::flash('infomessage',$parameter->name.' - deleted');

        return redirect('admin/parameter/group/'.$parameter['parameter_group_id']);
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $published = 0;
        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;

        if(Parameter::find($id)->update($input))
            Session::flash('infomessage','Изменения сохранены');

        return redirect('admin/parameter/group/'.$input['parameter_group_id']);
    }
}
