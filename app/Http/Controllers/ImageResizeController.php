<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
    {}
}
