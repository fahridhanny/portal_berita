<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function index($locale = ''){
        App::setLocale($locale);
        session()->put('language', $locale);
    
        $url_path = parse_url(url()->previous(), PHP_URL_PATH);
        $url_segments = explode('/', $url_path);
        if($url_segments[1] == 'id'){
            $url = str_replace('/id', app()->getLocale(), $url_path);
        }else{
            $url = str_replace('/en', app()->getLocale(), $url_path);
        }
        //dd($url);
        return redirect($url);
    }
}
