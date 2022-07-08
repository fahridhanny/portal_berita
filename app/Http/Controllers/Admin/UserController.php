<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = User::orderby('id', 'desc')->get();
        return view('pages.admin.user', compact('user'));
    }
    public function formUser(){
        return view('pages.admin.tambah_user');
    }
    public function tambahUser(Request $request){
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'nama.required' => 'nama tidak boleh kosong',
            'nama.string' => 'nama harus string',
            'nama.max' => 'nama max 255 karakter',
            'email.required' => 'email tidak boleh kosong',
            'email.string' => 'email harus string',
            'email.email' => 'format email harus ada @',
            'email.max' => 'email max 255 karakter',
            'email.unique' => 'email tidak boleh sama',
            'password.required' => 'password tidak boleh kosong',
            'password.string' => 'password harus string',
            'password.min' => 'password min 8 karakter',
            'password.confirmed' => 'password tidak sama',
        ]);
        
        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin/user')->with(['success' => 'Berhasil membuat user']);
    }
    public function formEditUser($id = ''){
        if ($id) {
            $user = User::where('id', $id)->first();
            if ($user) {
                return view('pages.admin.edit_user', compact('user'));
            }else{
                return redirect('/admin/home');
            }
        }else{
            return redirect('/admin/home');
        }
    }
    public function editUser($id = '', Request $request){
        if ($id) {
            $request->validate([
                'nama' => 'required',
                'email' => 'required'
            ], [
                'nama.required' => 'nama tidak boleh kosong',
                'email.required' => 'email tidak boleh kosong'
            ]);
    
            $user = User::where('id', $id)->first();
            if ($user) {
                $user->name = $request->nama;
                $user->email = $request->email;
                $request->save();
    
                return redirect()->back()->with(['success' => 'Berhasil merubah user']);
            }else{
                return redirect()->back()->with(['error' => 'gagal merubah user']);
            }
        } else {
            return redirect('/admin/home');
        }
    }
    public function hapusUser($id = ''){
        if ($id) {
            $user = User::where('id', $id)->first();
            if ($user) {
                $user->delete();
                return redirect()->back()->with(['success' => 'Berhasil menghapus user']);
            }else{
                return redirect()->back()->with(['error' => 'gagal menghapus user']);
            }
        } else {
            return redirect('/admin/home');
        }
    }
}
