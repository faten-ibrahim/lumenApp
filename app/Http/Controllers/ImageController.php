<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudder;
class ImageController
{
    public function upload(Request $request)
    {
        $file_url = "https://res.cloudinary.com/du9jugrtd/image/upload/v1567520817/sample.jpg";
        if ($request->hasFile('image') && $request->file('image')->isValid()){
        $cloudder = Cloudder::upload($request->file('image')->getRealPath());
        $uploadResult = $cloudder->getResult();
        $file_url = $uploadResult["url"];
        }
        return response()->json(['file_url' => $file_url], 200);
    }
}