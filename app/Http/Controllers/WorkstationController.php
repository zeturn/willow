<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryBranchUser;
use App\Models\EntryVersion;
use App\Models\EntryVersionTask;
use App\Models\EntityWallAssociation;

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
