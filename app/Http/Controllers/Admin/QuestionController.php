<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Paper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Question;
use Excel;
use Input;

class QuestionController extends Controller
{
    //
    public function index(){
        $data = Question::get();

        return view('admin.question.index',compact('data'));

    }

    //Excel文件导出功能 By Laravel学院
    public function export(){
        $cellData = [
            ['序号','题干','所属试卷','分值','选项','正确答案','添加时间'],
        ];
        $data = Question::all();
        foreach ($data as $key => $value) {
            $cellData[] =[
                $value -> id,
                $value -> question,
                $value -> paper -> paper_name,
                $value -> score,
                $value -> options,
                $value -> answer,
                $value -> created_at,
            ];
        }
//        dd($cellData);
        Excel::create(sha1(time().rand(1000,9999)),function($excel) use ($cellData){

            $excel->sheet('题库', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xlsx');
    }

    public function import(){
        if(Input::method() == 'POST'){

            $filePath ='.' . Input::get('excelpath');
            Excel::load($filePath, function($reader) {
                $data = $reader->getSheet(0) -> toArray();
                $temp = '';
                foreach ($data as $key => $value){
                    if($key == '0'){
                        continue;
                    }
                    $temp[] =[
                      'question'    =>      $value[0],
                       'paper_id'   =>      Input::get('paper_id'),
                        'score'     =>      $value[3],
                        'options'   =>      $value[1],
                        'answer'    =>      $value[2],
                        'created_at'    =>  date('Y-m-d H:i:s')
                    ];
                }
                $result = Question::insert($data);
                echo  $result ? '1' : '0';
            });
        }else{
            $list = \App\Admin\Paper::get();
            return view('admin.question.import',compact('list'));
        }

    }
}
