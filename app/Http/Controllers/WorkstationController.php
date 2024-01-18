<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkstationController extends Controller
{
    /**
     * 每个人的工作站
     * 
     * 登录注册后跳转至此
     * 
     */
    public function index()
    {
        return view('workstation.index');
    }
    
}
