<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Content;
use App\ContentRelated;
use App\ContentTag;
use App\MetaContent;
use App\Tag;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function berita(){
        //dd(request()->segment(1));
        $contents = Content::orderBy('id', 'desc')->get();
        return view('pages.admin.berita', compact('contents'));
    }

    public function getTags(){
        $tag = Tag::get();
        return $tag;
    }

    public function getBerita(){
        $content = Content::get();
        return $content;
    }

    public function tambahRelated(Request $request){
        dd($request->all());
    }

    public function formBerita(){
        $category = Category::all();
        return view('pages.admin.tambah_berita', compact('category'));
    }

    public function tambahBerita(Request $request){
        $request->validate([
            'category' => 'required',
            'judul' => 'required',
            'content' => 'required',
            'judul_en' => 'required',
            'content_en' => 'required',
            'meta_title' => 'required',
            'meta_desc' => 'required',
            'meta_keywords' => 'required',
            'meta_title_en' => 'required',
            'meta_desc_en' => 'required',
            'meta_keywords_en' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'tag' => 'required',
            'related' => 'required'
        ], [
            'category.required' => 'category harus dipilih',
            'judul.required' => 'judul tidak boleh kosong',
            'content.required' => 'content tidak boleh kosong',
            'judul_en.required' => 'judul_en tidak boleh kosong',
            'content_en.required' => 'content_en tidak boleh kosong',
            'meta_title.required' => 'meta_title tidak boleh kosong',
            'meta_desc.required' => 'meta_desc tidak boleh kosong',
            'meta_keywords.required' => 'meta_keywords tidak boleh kosong',
            'meta_title_en.required' => 'meta_title_en tidak boleh kosong',
            'meta_desc_en.required' => 'meta_desc_en tidak boleh kosong',
            'meta_keywords_en.required' => 'meta_keywords_en tidak boleh kosong',
            'image.required' => 'image tidak boleh kosong',
            'image.mimes' => 'image harus jpg, png, jpeg, gif, svg',
            'image.max' => 'image max ukuran 2048',
            'tag.required' => 'tag tidak boleh kosong',
            'related.required' => 'related tidak boleh kosong'
        ]);
        //dd($request);
        $tag = explode(',', $request->tag);
        $related = explode(',', $request->related);

        if (count($related) != 3) {
            return redirect()->back()->with(['error' => 'Related harus berjumlah 3']);
        }

        $content = new Content();
        $content->id_author = auth()->user()->id;
        $content->id_category = $request->category;
        $content->title = Str::slug($request->judul, '-');
        $content->judul = $request->judul;
        $content->content = $request->content;
        $content->title_en = Str::slug($request->judul_en, '-');
        $content->judul_en = $request->judul_en;
        $content->content_en = $request->content_en;
        
        $title = Str::slug($request->judul, '-');

        $nameImage = $title.'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $nameImage);
                
        $content->image = $nameImage;
        $content->status = 1;
        $content->save();

        $newContent = Content::where("judul", $request->judul)->first();
        if ($newContent) {
            foreach ($tag as $key => $value) {
                $content_tag = new ContentTag();
                $content_tag->id_content = $newContent->id;
                $content_tag->id_tag = $value;
                $content_tag->save();
            }

            foreach ($related as $key => $value) {
                $content_related = new ContentRelated();
                $content_related->id_content = $newContent->id;
                $content_related->id_related = $value;
                $content_related->save();
            }

            $metaContent = new MetaContent();
            $metaContent->id_content = $newContent->id;
            $metaContent->meta_title = $request->meta_title;
            $metaContent->meta_desc = $request->meta_desc;
            $metaContent->meta_keywords = $request->meta_keywords;
            $metaContent->meta_title_en = $request->meta_title_en;
            $metaContent->meta_desc_en = $request->meta_desc_en;
            $metaContent->meta_keywords_en = $request->meta_keywords_en;
            $metaContent->save();
        }else{
            return redirect()->back()->with(['error' => 'content yang dituju tidak ditemukan']); 
        }

        return redirect('/admin/content')->with(['success' => 'Berhasil menambah berita']);
    }

    public function formEditBerita($title = '', Request $request){
        if ($title) {
            $content = Content::where('title', $title)->first();       
            if($content){
                $meta = MetaContent::where('id_content', $content->id)->first();
                $category = Category::all();
                $content_tag = ContentTag::join('contents', 'contents.id', '=', 'content_tags.id_content')
                                            ->join('tags', 'tags.id', '=', 'content_tags.id_tag')
                                            ->where("title", $title)->get();
                $content_related = ContentRelated::join('contents', 'contents.id', '=', 'content_related.id_related')
                                                ->where("id_content", $content->id)->get();
                return view('pages.admin.edit', compact('content', 'category', 'meta', 'content_tag', 'content_related'));
            }else{
                return redirect('/admin/home')->with(['error' => 'Ada data yang belum lengkap']);
            }
        }else{
            return redirect('/admin/home');
        }
    }

    public function editBerita($title = '', Request $request){

        if($title){
            if ($request->imageValue) {

                $request->validate([
                    'category' => 'required',
                    'judul' => 'required',
                    'content' => 'required',
                    'judul_en' => 'required',
                    'content_en' => 'required',
                    'meta_title' => 'required',
                    'meta_desc' => 'required',
                    'meta_keywords' => 'required',
                    'meta_title_en' => 'required',
                    'meta_desc_en' => 'required',
                    'meta_keywords_en' => 'required',
                    // 'tag' => 'required'
                ], [
                    'category.required' => 'category tidak boleh kosong',
                    'judul.required' => 'judul tidak boleh kosong',
                    'content.required' => 'content tidak boleh kosong',
                    'judul_en.required' => 'judul_en tidak boleh kosong',
                    'content_en.required' => 'content_en tidak boleh kosong',
                    'meta_title.required' => 'meta_title tidak boleh kosong',
                    'meta_desc.required' => 'meta_desc tidak boleh kosong',
                    'meta_keywords.required' => 'meta_keywords tidak boleh kosong',
                    'meta_title_en.required' => 'meta_title_en tidak boleh kosong',
                    'meta_desc_en.required' => 'meta_desc_en tidak boleh kosong',
                    'meta_keywords_en.required' => 'meta_keywords_en tidak boleh kosong',
                    // 'tag.required' => 'tag tidak boleh kosong'
                ]);
                $tags = explode(',', $request->tag);
                $content_related = explode(',', $request->related);

                if (count($content_related) != 3) {
                    return redirect()->back()->with(['error' => 'Related harus berjumlah 3']);
                }

                $content = Content::where('title', $request->title)->first();
    
                if($content){
                    $content->id_category = $request->category;
                    $content->title = Str::slug($request->judul, '-');
                    $content->judul = $request->judul;
                    $content->content = $request->content;
                    $content->title_en = Str::slug($request->judul_en, '-');
                    $content->judul_en = $request->judul_en;
                    $content->content_en = $request->content_en;
                    $content->save();

                    $content_tag = ContentTag::where('id_content', $content->id)->get();
                    if($content_tag){
                        $tag = Tag::all();
                        $tagArr = array();
                        foreach ($tag as $value) {
                            foreach ($tags as $data) {
                                if($data == $value->name){
                                    array_push($tagArr, $value->id);
                                }
                            }
                        }
                        
                        foreach ($content_tag as $data) {
                            $data->delete();        
                        }
                        foreach ($tagArr as $value) {
                            $newTag = new ContentTag();
                            $newTag->id_content = $content->id;
                            $newTag->id_tag = $value;
                            $newTag->save();
                        }
                    }

                    $related = ContentRelated::where('id_content', $content->id)->get();
                    if ($related) {
                        $getContent = Content::get();
                        $arrRelated = array();
                        foreach ($getContent as $key => $data) {
                            foreach ($content_related as $key => $value) {
                                if ($data->judul == $value) {
                                    array_push($arrRelated, $data->id);
                                }
                            }
                        }

                        foreach ($related as $key => $value) {
                            $value->delete();
                        }

                        foreach ($arrRelated as $key => $value) {
                            $newRelated = new ContentRelated();
                            $newRelated->id_content = $content->id;
                            $newRelated->id_related = $value;
                            $newRelated->save();
                        }
                    }
    
                    $metaContent = MetaContent::where('id_content', $content->id)->first();
                    if ($metaContent) {
                        $metaContent->id_content = $content->id;
                        $metaContent->meta_title = $request->meta_title;
                        $metaContent->meta_desc = $request->meta_desc;
                        $metaContent->meta_keywords = $request->meta_keywords;
                        $metaContent->meta_title_en = $request->meta_title_en;
                        $metaContent->meta_desc_en = $request->meta_desc_en;
                        $metaContent->meta_keywords_en = $request->meta_keywords_en;
                        $metaContent->save();
                    }else{
                        $newMetaContent = new MetaContent();
                        $newMetaContent->id_content = $content->id;
                        $newMetaContent->meta_title = $request->meta_title;
                        $newMetaContent->meta_desc = $request->meta_desc;
                        $newMetaContent->meta_keywords = $request->meta_keywords;
                        $newMetaContent->meta_title_en = $request->meta_title_en;
                        $newMetaContent->meta_desc_en = $request->meta_desc_en;
                        $newMetaContent->meta_keywords_en = $request->meta_keywords_en;
                        $newMetaContent->save();
                    }
                        
                    return redirect('/admin/content')->with(['success' => 'Berhasil merubah berita']);
                }else{
                    return redirect('/admin/content')->with(['error' => 'Berita yang diubah tidak sesuai']);
                }
            }
            
            $request->validate([
                'category' => 'required',
                'judul' => 'required',
                'content' => 'required',
                'judul_en' => 'required',
                'content_en' => 'required',
                'meta_title' => 'required',
                'meta_desc' => 'required',
                'meta_keywords' => 'required',
                'meta_title_en' => 'required',
                'meta_desc_en' => 'required',
                'meta_keywords_en' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'tag' => 'required'
            ], [
                'category.required' => 'category tidak boleh kosong',
                'judul.required' => 'judul tidak boleh kosong',
                'content.required' => 'content tidak boleh kosong',
                'judul_en.required' => 'judul_en tidak boleh kosong',
                'content_en.required' => 'content_en tidak boleh kosong',
                'meta_title.required' => 'meta_title tidak boleh kosong',
                'meta_desc.required' => 'meta_desc tidak boleh kosong',
                'meta_keywords.required' => 'meta_keywords tidak boleh kosong',
                'meta_title_en.required' => 'meta_title_en tidak boleh kosong',
                'meta_desc_en.required' => 'meta_desc_en tidak boleh kosong',
                'meta_keywords_en.required' => 'meta_keywords_en tidak boleh kosong',
                'image.required' => 'image tidak boleh kosong',
                'image.mimes' => 'image harus jpg, png, jpeg, gif, svg',
                'image.max' => 'image max ukuran 2048',
                'tag.required' => 'tag tidak boleh kosong'
            ]);
            $tags = explode(',', $request->tag);
            $content_related = explode(',', $request->related);

            if (count($content_related) != 3) {
                return redirect()->back()->with(['error' => 'Related harus berjumlah 3']);
            }


            $content = Content::where('title', $request->title)->first();
    
            if($content){
                $content->id_category = $request->category;
                $content->tag = $request->tag;
                $content->title = Str::slug($request->judul, '-');
                $content->judul = $request->judul;
                $content->content = $request->content;
                $content->title_en = Str::slug($request->judul_en, '-');
                $content->judul_en = $request->judul_en;
                $content->content_en = $request->content_en;
                        
                $nameImage = $request->title.'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('images'), $nameImage);
                    
                $content->image = $nameImage;
                $content->save();

                $content_tag = ContentTag::where('id_content', $content->id)->get();
                if($content_tag){
                    $tag = Tag::all();
                    $tagArr = array();
                    foreach ($tag as $value) {
                        foreach ($tags as $data) {
                            if($data == $value->name){
                                array_push($tagArr, $value->id);
                            }
                        }
                    }
                        
                    foreach ($content_tag as $data) {
                        $data->delete();        
                    }
                    foreach ($tagArr as $value) {
                        $newTag = new ContentTag();
                        $newTag->id_content = $content->id;
                        $newTag->id_tag = $value;
                        $newTag->save();
                    }
                }

                $related = ContentRelated::where('id_content', $content->id)->get();
                    if ($related) {
                        $getContent = Content::get();
                        $arrRelated = array();
                        foreach ($getContent as $key => $data) {
                            foreach ($content_related as $key => $value) {
                                if ($data->judul == $value) {
                                    array_push($arrRelated, $data->id);
                                }
                            }
                        }

                        foreach ($related as $key => $value) {
                            $value->delete();
                        }

                        foreach ($arrRelated as $key => $value) {
                            $newRelated = new ContentRelated();
                            $newRelated->id_content = $content->id;
                            $newRelated->id_related = $value;
                            $newRelated->save();
                        }
                    }
    
                $metaContent = MetaContent::where('id_content', $content->id)->first();
                if ($metaContent) {
                    $metaContent->id_content = $content->id;
                    $metaContent->meta_title = $request->meta_title;
                    $metaContent->meta_desc = $request->meta_desc;
                    $metaContent->meta_keywords = $request->meta_keywords;
                    $metaContent->meta_title_en = $request->meta_title_en;
                    $metaContent->meta_desc_en = $request->meta_desc_en;
                    $metaContent->meta_keywords_en = $request->meta_keywords_en;
                    $metaContent->save();
                }else{
                    $newMetaContent = new MetaContent();
                    $newMetaContent->id_content = $content->id;
                    $newMetaContent->meta_title = $request->meta_title;
                    $newMetaContent->meta_desc = $request->meta_desc;
                    $newMetaContent->meta_keywords = $request->meta_keywords;
                    $newMetaContent->meta_title_en = $request->meta_title_en;
                    $newMetaContent->meta_desc_en = $request->meta_desc_en;
                    $newMetaContent->meta_keywords_en = $request->meta_keywords_en;
                    $newMetaContent->save();
                }
                        
                return redirect('/admin/content')->with(['success' => 'Berhasil merubah berita']);
            }else{
                return redirect('/admin/content')->with(['error' => 'Berita yang diubah tidak sesuai']);
            }
        }else{
            return redirect('/admin/content');
        }
    }

    public function hapusBerita($title = ''){
        if ($title) {
            $content = Content::where('title', $title)->first();

            if($content){
                $content_tag = ContentTag::where('id_content', $content->id)->get();
                if($content_tag){
                    foreach ($content_tag as $data) {
                        $data->delete();
                    }    
                }
                $content_related = ContentRelated::where('id_content', $content->id)->get();
                if($content_related){
                    foreach ($content_related as $data) {
                        $data->delete();
                    }    
                }
                $meta = MetaContent::where('id_content', $content->id)->first();
                if($meta){
                    $meta->delete();
                }
                
                $image_path = public_path('images/').$content->image;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $content->delete();
                return redirect()->back()->with(['success' => 'Berhasil menghapus berita']);
            }else{
                return redirect()->back()->with(['error' => 'Berita yang dihapus tidak sesuai']);      
            }
        }else{
            return redirect('/admin/home');
        }
    }

    public function publishBerita(Request $request){
        $content = Content::where("id", $request->id)->first();
        if($content){
            $content->status = $request->status;
            $content->save();

            return response()->json([
                'status' => '200',
                'message' => 'Success update status'
            ]);
        }else{
            return response()->json([
                'status' => '404',
                'message' => 'Invalid content'
            ]);
        }
    }

    public function priview($title = ''){
        if ($title == '') {
            return redirect('/admin/content');
        }
        $content = Content::where('title', $title)->first();
        if ($content == '') {
            return redirect('/admin/content');
        }
        $content_tag = ContentTag::where('id_content', $content->id)->get();
        if($content_tag){
            $tag = Tag::get();
            $arrTag = array();
            foreach ($content_tag as $data) {
                foreach ($tag as $value) {
                    if ($data->id_tag == $value->id) {
                        array_push($arrTag, $value->name);
                    }
                }
            }
            $content['tag'] = $arrTag;    
        }else{
            $content['tag'] = '';    
        }
        return view('pages.admin.priview', compact('content'));
    }
}
