<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function index(){
        $tag = Tag::all();
        return view("pages.admin.tag", compact('tag'));
    }

    public function formTag(){
        return view("pages.admin.tambah_tag");
    }

    public function tambahTag(Request $request){
        $tag = new Tag();
        $tag->name_id = $request->name_id;
        $tag->name_en = $request->name_en;
        $tag->save();

        return redirect()->back()->with(['success' => 'berhasil menambah data']);
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
            'name_id' => 'required',
            'name_en' => 'required',
        ],[
            'name_id.required' => 'name_id tidak boleh kosong',
            'name_en.required' => 'name_en tidak boleh kosong',
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