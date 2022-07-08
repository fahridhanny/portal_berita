<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function index(){
        $tag = Tag::orderby('id', 'DESC')->get();
        return view("pages.admin.tag", compact('tag'));
    }

    public function formTag(){
        return view("pages.admin.tambah_tag");
    }

    public function tambahTag(Request $request){
        
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'name tidak boleh kosong',
            'description.required' => 'description tidak boleh kosong',
        ]);

        try {
            $tag = new Tag();
            $tag->name = $request->name;
            $tag->description = $request->description;
            $tag->save();

            return redirect("/admin/tag")->with(['success' => 'berhasil menambah data']);
        } catch (\Throwable $th) {
            return redirect("/admin/tag")->with(['error' => 'gagal menambah data']);
        }
        
    }

    public function formEditTag($id = ''){
        if($id){
            $tag = Tag::where('id', $id)->first();
            if($tag){
                return view('pages.admin.edit_tag', compact('tag'));
            }else{
                return redirect('/admin/tag')->with(['error' => 'tidak ada halaman yang dituju']);
            }
        }else{
            return redirect('/admin/tag')->with(['error' => 'tidak ada halaman yang dituju']);
        }
    }

    public function editTag($id, Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ],[
            'name.required' => 'name tidak boleh kosong',
            'description.required' => 'description tidak boleh kosong',
        ]);

        if($id){
            $tag = Tag::where('id', $id)->first();
            if($tag){
                $tag->name_id = $request->name_id;
                $tag->name_en = $request->name_en;
                $tag->save();

                return redirect('/admin/tag')->with(['success' => 'berhasil merubah data']);
            }else{
                return redirect('/admin/tag')->with(['error' => 'gagal merubah data']);
            }
        }else{
            return redirect('/admin/tag')->with(['error' => 'gagal merubah data']);
        }
    }

    public function hapusTag($id){
        if($id){
            $tag = Tag::where('id', $id)->first();
            if($tag){
                $tag->delete();
                return redirect('/admin/tag')->with(['success' => 'berhasil menghapus data']);
            }else{
                return redirect('/admin/tag')->with(['error' => 'gagal menghapus data']);
            }
        }else{
            return redirect('/admin/tag')->with(['error' => 'gagal menghapus data']);
        }
    }
}
