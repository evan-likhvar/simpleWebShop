<?php

namespace App\Http\Controllers\Admin;

use App\Parameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
        if (empty(trim($input['name']))) {
            Session::flash('infomessage', 'У параметра должно быть не пустое название!!!');
            return redirect('admin/parameter/group/'.$input['parameter_group_id']);
        }
        if (count(Parameter::where('name',$input['name'])->get())){
            Session::flash('infomessage', 'Параметер с именем '.$input['name'].' уже существует!!!');
            return redirect('admin/parameter/group/'.$input['parameter_group_id']);
        }

        Parameter::create($input);
        return redirect('admin/parameter/group/'.$input['parameter_group_id']);
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
        $p = DB::table('article_parameter')
            ->select('id')
            ->where('parameter_id','=',$id)->get();

        if(count($p)){
            Session::flash('infomessage','Нельзя удалить параметер, у которго есть привязка к товарам');
            return redirect('admin/parameter/group/'.$parameter['parameter_group_id']);
        }


        if($parameter->delete())
            Session::flash('infomessage',$parameter->name.' - удален из базы');

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
