<?php

use App\Models\Category;

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

