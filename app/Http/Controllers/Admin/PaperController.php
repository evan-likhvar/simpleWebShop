<?php

namespace App\Http\Controllers\Admin;

use App\paper;
use App\papercategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PaperController extends AdminController
{
    //
    public function PaperCategoryIndex(){

        $papercategory = papercategory::all();

        $parGrp = $this->parameterGroups;
        return view('admin.papers.index')->with(compact('papercategory','parGrp'));
    }

    public function PaperCategoryStore(Request $request){
        $input = $request->all();
        papercategory::create($input);
        return redirect('admin/paperCategory');
    }

    public function editPaperCategory($id){

        $papercategory = papercategory::FindOrFail($id);
        $parGrp = $this->parameterGroups;

        return view('admin.papers.edit')->with(compact('papercategory','parGrp'));

    }

    public function PaperCategoryDestroy($id){

        $papercategory = papercategory::find($id);

        if($papercategory->delete())
            Session::flash('infomessage',$papercategory->name.' - удален из базы');
        return redirect('admin/paperCategory');
    }

    public function PaperCategoryUpdate(Request $request, $id){

        $input = $request->all();
        $published = 0;
        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;

        if(papercategory::find($id)->update($input))
            Session::flash('infomessage','Изменения сохранены');

        return redirect('admin/paperCategory');
    }

    public function PaperIndex(){

        $paper = paper::paginate(20);

        $parGrp = $this->parameterGroups;
        return view('admin.papers.paper_index')->with(compact('paper','parGrp'));
    }

    public function createNewPaper()
    {

        $parGrp = $this->parameterGroups;

        $categories = papercategory::select('name','id')->get()->pluck('name','id')->toArray();

        //return dd($parGrp,$paperCategory);


        return view('admin.papers.newPaper')->with(compact('parGrp','categories'));
    }

    public function PaperStore(Request $request){

        $input = $request->all();
        //return dd($input);

        paper::create($input);
        return redirect('admin/paper');
    }

    public function PaperDestroy($id){

        $paper = paper::find($id);

        if($paper->delete())
            Session::flash('infomessage',$paper->name.' - удален из базы');
        return redirect('admin/paper');
    }

    public function editPaper($id){


        $categories = papercategory::select('name','id')->get()->pluck('name','id')->toArray();

        $paper = paper::FindOrFail($id);

        $parGrp = $this->parameterGroups;


//        return dd($id,$paper,$paper->papercategory,$paperCategory->papers);



        return view('admin.papers.editPaper')->with(compact('paper','parGrp','categories'));

    }

    public function PaperUpdate(Request $request, $id){

        $input = $request->all();
        $published = 0;

        unset($input['redirects_to']);

        if (isset($request->published)) if ($request->published == 'on') $published = 1;
        $input['published'] = $published;

        if(paper::find($id)->update($input))
            Session::flash('infomessage','Изменения сохранены');

        return redirect('admin/paper');
    }
}
