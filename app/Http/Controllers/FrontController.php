<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{

    protected function getCountCartItems(){
        return count(Session::get('cartItems[]'));
    }
}
