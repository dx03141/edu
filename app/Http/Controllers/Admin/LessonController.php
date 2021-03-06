<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Lesson;
use Input;

class LessonController extends Controller
{
    //
    public function index(){
        $data = Lesson::orderBy('sort','desc') ->get();

        return view('admin.lesson.index',compact('data'));
    }

    public function play(){
        $id = Input::get('id');
        $addr = Lesson::where('id',$id) ->value('video_addr');

        return "<video src='$addr'  width='99%' controls='controls'>您的浏览器不支持 video 标签。</video>";
    }
}
