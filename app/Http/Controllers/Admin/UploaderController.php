<?php

namespace App\Http\Controllers\Admin;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class UploaderController extends Controller
{
    //
    public function webuploader(Request $request){

        if($request -> hasFile('file') && $request -> file('file') -> isValid()){
            $filename = sha1(time() . $request -> file('file') ->getClientOriginalName()) . '.' . $request ->file('file') ->getClientOriginalExtension();
            storage::disk('public') ->put($filename,file_get_contents($request -> file('file') ->path()));

            $result=[
                'errCode' => '00001',
                'errMsg' => '',
                'succMsg' => '文件上传成功',
                'path' => '/storage/'.$filename,
            ];

        }else{
            $result =[
              'errCode' => '00001',
              'errMsg' => $request -> file('file') ->getErrorMessage()
            ];
        }
        return Response() -> json($result);
    }

    public function qiniu(Request $request){

        if($request -> hasFile('file') && $request -> file('file') -> isValid()){
            $filename = sha1(time() . $request -> file('file') ->getClientOriginalName()) . '.' . $request ->file('file') ->getClientOriginalExtension();
            storage::disk('qiniu') ->put($filename,file_get_contents($request -> file('file') ->path()));

            $result=[
                'errCode' => '00001',
                'errMsg' => '',
                'succMsg' => '文件上传成功',
                'path' =>  storage::disk('qiniu') ->getDriver()->downloadUrl($filename)
            ];

        }else{
            $result =[
                'errCode' => '00001',
                'errMsg' => $request -> file('file') ->getErrorMessage()
            ];
        }
        return Response() -> json($result);
    }
}
