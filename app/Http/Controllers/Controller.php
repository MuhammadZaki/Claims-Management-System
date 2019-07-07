<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fileUpload($doc_id,$patient_id,$request,$input)
    {
        $uploads_dir = '/uploads';
        $date = date('d-m-Y');
        if (!Storage::exists($uploads_dir)){
            Storage::makeDirectory($uploads_dir);
        }
        if (!Storage::exists($uploads_dir.'/'.$doc_id)){
            Storage::makeDirectory($uploads_dir.'/'.$doc_id);
        }
        if (!Storage::exists($uploads_dir.'/'.$doc_id.'/'.$patient_id)){
            Storage::makeDirectory($uploads_dir.'/'.$doc_id.'/'.$patient_id);
        }
        if (!Storage::exists($uploads_dir.'/'.$doc_id.'/'.$patient_id.'/'.$date)){
            Storage::makeDirectory($uploads_dir.'/'.$doc_id.'/'.$patient_id.'/'.$date);
        }
        $destinationPath = storage_path($uploads_dir.'/'.$doc_id.'/'.$patient_id.'/'.$date.'/');
        $extension = $request->file($input)->getClientOriginalExtension();
        $fileName = 'file'.$doc_id.'-'.$patient_id.'-'.time() . '.' . $extension;
        $request->file($input)->move($destinationPath, $fileName);
        return $fileName;
    }


    function upload($request, $dir, $input = 'image')
    {
        $destinationPath = storage_path('uploads/' . $dir);
        $extension = $request->file($input)->getClientOriginalExtension();
        $fileName = $dir . "_" . time() . '.' . $extension;
        $request->file($input)->move($destinationPath, $fileName);
        return $fileName;
    }


    function getImage($dir, $filename)
    {
        $path = storage_path('uploads/' . $dir . '/' . $filename);
        $file = \File::get($path);
        $type = \File::mimeType($path);
        return \Response::make($file, 200)->header("Content-Type", $type);
    }

   
}
