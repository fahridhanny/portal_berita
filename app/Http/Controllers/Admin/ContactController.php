<?php

namespace App\Http\Controllers\admin;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function contact(){
        $contact = Contact::all();
        //dd($contact);
        return view('pages.admin.contact', compact('contact'));
    }
    public function hapusContact($id = ''){
       if ($id) {
           $contact = Contact::where('id', $id)->first();
           if ($contact) {
                $contact->delete();
                return redirect()->back()->with(['success' => 'Berhasil menghapus contact']);
           }else{
                return redirect()->back()->with(['error' => 'Gagal menghapus contact']);
           }
       }else{
            return redirect()->back()->with(['error' => 'Gagal menghapus contact']);
       }
       
    }
}
