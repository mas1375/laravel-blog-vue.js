<?php

namespace App\Http\Controllers;


class PagesController extends Controller
{
    public function index()
    {
        $title = 'index page';

        return view('pages.index')->with('title' , $title);
    }

    public function about()
    {
        $title = 'about page';
        return view('pages.about')->with('title' , $title);
    }

    public function services()
    {
        $data = [
            'title' => 'services page' ,
            'services' => ['service 1' , 'service 2' , 'service 3'],
        ];
        return view('pages.services')->with($data);
    }

}
