<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;
use App\Category;
use App\Banner;
use App\Contact;
use App\MetaContent;
use App\Tag;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home()
    {
        $content = Content::all();
        $category = Category::all();
        $banner = Banner::all();
        $user = User::all();
        $contact = Contact::all();
        $tag = Tag::all();

        return view('pages.admin.home', compact('content', 'category', 'banner', 'user', 'contact', 'tag'));
    }

}
