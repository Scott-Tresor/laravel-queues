<?php

namespace App\Http\Controllers;


use App\Jobs\ResizeJob;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ImageResizeController extends Controller
{
    /***
     * @return Application|Factory|View
     * @author scotttresor@gmail.com
     */
    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $uploadFiles = $request->file('images');
        $file = $uploadFiles->move(public_path('uploads'), $uploadFiles->getClientOriginalName());

        $formats = [100, 200, 400, 600,  800, 1000, 1024];
        $this->dispatch(new ResizeJob($file, $formats, 'scotttresor@gmail.com'));

        return view('images.create');
    }
}
