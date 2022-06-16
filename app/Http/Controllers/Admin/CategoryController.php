<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    Public function index(){
        $category = Category::all();
        return view('pages.admin.category', compact('category'));
    }

    public function formKategori(){
       return view('pages.admin.tambah_category'); 
    }

    public function tambahKategori(Request $request){
        $request->validate([
            'category' => 'required',
            'category_en' => 'required'
        ], [
            'category.required' => 'category tidak boleh kosong',
            'category_en.required' => 'category_en tidak boleh kosong'
        ]);

        $kategori = new Category();
        $kategori->category = $request->category;
        $kategori->category_en = $request->category_en;
        $kategori->save();

        return redirect('/admin/kategori')->with(['success' => 'Berhasil menambah kategori']);
    }

    public function formEditKategori($title = ''){
        if ($title) {
            $category = Category::where('category', $title)->first();
            if($category){
                return view('pages.admin.edit_category', compact('category'));
            }else{
                return redirect('/admin/home');
            }
        }else{
            return redirect('/admin/home');
        }
    }

    public function editKategori($title = '', Request $request){
        
        if($title){
            $request->validate([
                'category' => 'required',
                'category_en' => 'required'
            ], [
                'category.required' => 'category tidak boleh kosong',
                'category_en.required' => 'category_en tidak boleh kosong'
            ]);
    
            $category = Category::where('category', $title)->first();
            if ($category) {
                $category->category = $request->category;
                $category->category_en = $request->category_en;
                $category->save();
    
                return redirect()->back()->with(['success' => 'Berhasil merubah category']);
            }else{
                return redirect()->back()->with(['error' => 'gagal merubah category']);
            }
        }else{
            return redirect('/admin/home');
        }
    }

    public function hapusKategori($id = ''){
        if($id){
            $category = Category::where('id', $id)->first();
            if ($category) {
                $category->delete();
                return redirect()->back()->with(['success' => 'berhasil menghapus category']);
            }else{
                return redirect()->back()->with(['error' => 'gagal menghapus category']);
            }
        }else{
            return redirect('/admin/home');
        }
    }
}
