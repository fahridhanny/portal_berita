<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Category;
use App\Contact;
use FarhanWazir\GoogleMaps\GMaps;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GMaps $gmaps)
    {
        //$this->middleware('auth');
        $this->gmaps = $gmaps;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        // $contents = Content::all();
        // $categorys = Category::all();
        return view('pages.index');   
    }

    public function contact(Request $request){
        return view('pages.contact');
    }

    public function sendMessage(Request $request){
        $request->validate([
            'nama' => ['required', 'regex:/^[a-zA-ZÑñ\s]+$/'],
            'email' => ['required', 'unique:contacts', 'email'],
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.regex' => 'nama harus huruf',
            'email.required' => 'email tidak boleh kosong',
            'email.unique' => 'email sudah didaftarkan',
            'email.email' => 'email harus ada @',
            'subject.required' => 'subject tidak boleh kosong',
            'message.required' => 'message tidak boleh kosong',
            'g-recaptcha-response.required' => 'Captcha tidak boleh kosong',
        ]);

        $contact = new Contact();
        $contact->nama = $request->nama;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->back()->with(['success' => 'Terimakasih telah mengirimkan pesan']);
    }

    public function maps(){
        $config = array();
        $config['center'] = '6.9271, 79.8612';
        $config['zoom'] = 13; 
        $config['map_height'] = '300px';
        $config['map_width'] = '500px'; 
        $config['scrollwheel'] = false;
        $this->gmaps->initialize($config);
        $map = $this->gmaps->create_map();

        return view('pages.maps', compact('map'));
    }
}
