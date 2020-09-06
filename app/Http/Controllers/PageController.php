<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public $textCenter = 'text-center';

    public function index(){
        $title = 'Welcome to TMBLOG';
        $textCenter = $this->textCenter;
        return view('pages.index',compact('title','textCenter'));
    }
    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title',$title)->with('textCenter',$this->textCenter);
    }
    public function services(){

        return view('pages.services',[
            'title' => 'Services',
            'services' => [
                'Web Design', 'Web Development','Programming','SEO',
            ],
            'textCenter' => $this->textCenter,
        ]);
    
    //    $data = array(
    //         'title' => 'Services',
    //         'services' => ['Web Design', 'Web Development','Programming','SEO']
    //    );
    //    return view('pages.services')->with($data); 

    }
}
