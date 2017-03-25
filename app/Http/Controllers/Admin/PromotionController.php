<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends AdminController
{
    public function createNewPromotion()
    {
        $parGrp = $this->parameterGroups;
        return view('admin.papers.newPaper')->with(compact('parGrp'));
    }
}
