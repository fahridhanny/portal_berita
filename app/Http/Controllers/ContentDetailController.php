<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\MetaContent;

class ContentDetailController extends Controller
{
    public function beritaDetail($title = '', Request $request){
        //dd($request->segment(count($request->segments()) / 1));

        if (app()->getLocale()) {
            $_language = app()->getLocale();
        } else {
            $_language = 'id';
        }

        //dd($_language);
        if($title != ''){

            $content = Content::where('title', $title)->first();
            if($content){
                $slug_id = $content->title;
                $slug_en = $content->title_en;
            }else{
                $content = Content::where('title_en', $title)->first();
                if($content){
                    $slug_id = $content->title;
                    $slug_en = $content->title_en;
                }else{
                    return redirect('/'.app()->getLocale());
                }
            }
            //dd($slug_id);

            $slug = request()->segment(count(request()->segments()));
            if($_language == 'id' && $slug != $slug_id){
                return redirect()->to('/id/berita/'.$slug_id);
            }elseif ($_language == 'en' && $slug != $slug_en) {
                return redirect()->to('/en/news/'.$slug_en);
            }

            $meta = MetaContent::where('id_content', $content->id)->first();
            if($meta){
                $content['meta'] = $meta;
            }else{
                $content['meta'] = '';
            }
            
            //dd(explode(',', $content->tag));
            return view('pages.detail_berita', compact('content'));
        }else{
            return redirect('/'.app()->getLocale());
        }
    }
}