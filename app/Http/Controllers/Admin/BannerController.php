<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index(){
        $banner = Banner::all();
        return view('pages.admin.banner', compact('banner'));
    }
    public function formBanner(){
        return view('pages.admin.tambah_banner');
    }
    public function tambahBanner(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ], [
            'title.required' => 'title tidak boleh kosong',
            'image.required' => 'image tidak boleh kosong',
            'image.required' => 'image tidak boleh kosong',
            'image.mimes' => 'image harus jpg, png, jpeg, gif, svg',
            'image.max' => 'image max ukuran 2048',
        ]);

        $banner = new Banner();
        $banner->title = $request->title;
        
        $nameImage = $request->title.'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/banner'), $nameImage);
                    
        $banner->image = $nameImage;
        $banner->save();
                
        return redirect('/admin/banner')->with(['success' => 'Berhasil menambah banner']); 
    }
    public function formEditBanner($title = ''){
        if ($title) {
            $banner = Banner::where('title', $title)->first();
            if ($banner) {
                return view('pages.admin.edit_banner', compact('banner'));
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/admin/home');
        }
    }
    public function editBanner($title = '', Request $request){
        
        if($title){
            if ($request->imageValue) {

                $request->validate([
                    'title' => 'required'
                ], [
                    'title.required' => 'title tidak boleh kosong'
                ]);
    
                $banner = Banner::where('title', $title)->first();
    
                if($banner){
                    $banner->title = $request->title;
                    $banner->save();
                        
                    return redirect()->back()->with(['success' => 'Berhasil merubah banner']);
                }else{
                    return redirect()->back()->with(['error' => 'Banner yang diubah tidak sesuai']);
                }
            }
            
            $request->validate([
                'title' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ], [
                'title.required' => 'title tidak boleh kosong',
                'image.required' => 'image tidak boleh kosong',
                'image.required' => 'image tidak boleh kosong',
                'image.mimes' => 'image harus jpg, png, jpeg, gif, svg',
                'image.max' => 'image max ukuran 2048',
            ]);
    
            $banner = Banner::where('title', $title)->first();
            if ($banner) {
                $banner->title = $request->title;
                
                $nameImage = $request->title.'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('images/banner'), $nameImage);
                    
                $banner->image = $nameImage;
                $banner->save();
                
                return redirect()->back()->with(['success' => 'Berhasil merubah banner']);
            }else{
                return redirect()->back()->with(['error' => 'Banner yang diubah tidak sesuai']);
            }
        }else{
            return redirect('/admin/home');
        }
    }
    public function hapusBanner($title = ''){
        if ($title) {
            $banner = Banner::where('title', $title)->first();
            if ($banner) {
                
                $image_path = public_path('images/banner/').$banner->image;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $banner->delete();
                return redirect()->back()->with(['success' => 'Berhasil menghapus banner']);
            }else{
                return redirect()->back()->with(['error' => 'Banner yang dihapus tidak sesuai']);
            }
        }else{
            return redirect('/admin/home');
        }
    }
}
