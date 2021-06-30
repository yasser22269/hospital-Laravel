<?php


use App\Models\Logs;

define('PAGINATION_COUNT', 30);

function getFolder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}


function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
 }


 function replaceurl($image){
    $photo =  str_replace('http://127.0.0.1:8000/', '',  $image);
    return  $photo;
 }

function logss($title){
    //Create Row in Logs
    $Logs = new Logs();
    $Logs->user_id= auth()->user()->id;
    $Logs->title = $title;
    $Logs->save();
    //End Create Row in Logs
    return  $Logs;
}

function typePage($title){
    if(auth()->user()->type_id != $title)
    return abort(404);
}


