<?php

namespace App\Http\Controllers\Admin;

use App\Parameter_group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected  $parameterGroups;

    public function __construct()
    {
        $this->middleware('auth');
        $this->parameterGroups = Parameter_group::all();
    }

    public function mainIndex()
    {
        $parGrp = $this->parameterGroups;
        return view('admin.adminapp')->with(compact('parGrp'));
    }
}
