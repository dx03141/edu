<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Course;

class CoureController extends Controller
{
    //
    public function index(){
        $data = Course::orderBy('sort','desc') ->get();

        return view('admin.course.index',compact('data'));
    }
}
