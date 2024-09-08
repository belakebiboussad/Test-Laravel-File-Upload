<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class ShopController extends Controller
{
    public function store(Request $request)
    {
        $filename = $request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('shops', $filename);
       // $image = Image::make($request->photo);
        $path = storage_path('app/shops/' . $filename);
         if (!File::exists($path)) {
            abort(404);
        }
        //$image = File::get($path);
        //$image = Storage::get('app/shops/'.$filename);
        $image = Image::make($path)->resize(500,500);

        //$image = Image::make(Storage::get('app/shops/'.$filename));
         //$image->resize(500,500);


        // TASK: resize the uploaded image from /storage/app/shops/$filename
        //   to size of 500x500 and store it as /storage/app/shops/resized-$filename
        // Use intervention/image package, it's already pre-installed for you
        //Storage::disk('app/shops')->put('resized-'.$filename, $image);
        $name ='resized-'.$filename;
       /* $image->save('app/shops/');*/
        Storage::move($name, 'app/shops/' . $name);

        // $store  = Storage::putFile('app/shops', $image);
        return 'Success';
    }
}
