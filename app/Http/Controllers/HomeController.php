<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Category;
use App\Contact;

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
}
