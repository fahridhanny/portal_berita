<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['namespace' => 'Auth'], function(){
    Route::get('/reload-captcha', 'LoginController@reloadCaptcha');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'auth'], function () {
    // show lfm
    Route::get('/', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    // show integration error message
    Route::get('/errors', '\Unisharp\Laravelfilemanager\controllers\LfmController@getErrors');
    // upload
    Route::post('/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload')->name('unisharp.lfm.upload');
    // list images & files
    Route::get('/jsonitems', '\Unisharp\Laravelfilemanager\controllers\ItemsController@getItems');
    // folders
    Route::get('/newfolder', '\Unisharp\Laravelfilemanager\controllers\FolderController@getAddfolder');
    Route::get('/deletefolder', '\Unisharp\Laravelfilemanager\controllers\FolderController@getDeletefolder');
    Route::get('/folders', '\Unisharp\Laravelfilemanager\controllers\FolderController@getFolders');
    // crop
    Route::get('/crop', '\Unisharp\Laravelfilemanager\controllers\CropController@getCrop');
    Route::get('/cropimage', '\Unisharp\Laravelfilemanager\controllers\CropController@getCropimage');
    Route::get('/cropnewimage', '\Unisharp\Laravelfilemanager\controllers\CropController@getNewCropimage');
    // rename
    Route::get('/rename', '\Unisharp\Laravelfilemanager\controllers\RenameController@getRename');
    // scale/resize
    Route::get('/resize', '\Unisharp\Laravelfilemanager\controllers\ResizeController@getResize');
    Route::get('/doresize', '\Unisharp\Laravelfilemanager\controllers\ResizeController@performResize');
    // download
    Route::get('/download', '\Unisharp\Laravelfilemanager\controllers\DownloadController@getDownload');
    // delete
    Route::get('/delete', '\Unisharp\Laravelfilemanager\controllers\DeleteController@getDelete');
    // demo
    Route::get('/demo', '\Unisharp\Laravelfilemanager\controllers\DemoController@index');
});
// dominan route
Route::group(['prefix' => '{locale?}', 'middleware' => ['bypass', 'language']], function(){
    Route::get('/', 'HomeController@index');
    Route::get('/berita/{title?}', 'ContentDetailController@beritaDetail');
    Route::get('/news/{title?}', 'ContentDetailController@beritaDetail');
    Route::get('/contact', 'HomeController@contact');
    Route::post('/contact', 'HomeController@sendMessage');
});

Route::get('/lang/{locale?}', 'LanguageController@index');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'backHistory']], function(){   
    Route::get('/home', 'HomeController@home');

    Route::get('/content', 'BeritaController@berita');
    Route::get('/tambah-berita', 'BeritaController@formBerita');
    Route::post('/tambah-berita', 'BeritaController@tambahBerita');
    Route::get('/edit-berita/{title?}', 'BeritaController@formEditBerita');
    Route::post('/edit-berita/{title?}', 'BeritaController@editBerita');
    Route::get('/hapus-berita/{title?}', 'BeritaController@hapusBerita');

    Route::get('/kategori', 'CategoryController@index');
    Route::get('/tambah-kategori', 'CategoryController@formKategori');
    Route::post('/tambah-kategori', 'CategoryController@tambahKategori');
    Route::get('/edit-kategori/{title?}', 'CategoryController@formEditKategori');
    Route::post('/edit-kategori/{title?}', 'CategoryController@editKategori');
    Route::get('/hapus-kategori/{id?}', 'CategoryController@hapusKategori');

    Route::get('/banner', 'BannerController@index');
    Route::get('/tambah-banner', 'BannerController@formBanner');
    Route::post('/tambah-banner', 'BannerController@tambahBanner');
    Route::get('/edit-banner/{title?}', 'BannerController@formEditBanner');
    Route::post('/edit-banner/{title?}', 'BannerController@editBanner');
    Route::get('/hapus-banner/{title?}', 'BannerController@hapusBanner');

    Route::get('/user', 'UserController@index');
    Route::get('/tambah-user', 'UserController@formUser');
    Route::post('/tambah-user', 'UserController@tambahUser');
    Route::get('/edit-user/{id?}', 'UserController@formEditUser');
    Route::post('/edit-user/{id?}', 'UserController@editUser');
    Route::get('/hapus-user/{id?}', 'UserController@hapusUser');

    Route::get('/tentang-kami', 'ContactController@contact');
    Route::get('/hapus-contact/{id?}', 'ContactController@hapusContact');

    Route::get('/tag', 'TagController@index');
    Route::get('/tambah-tag', 'TagController@formTag');
    Route::post('/tambah-tag', 'TagController@tambahTag');
    Route::get('/edit-tag/{id?}', 'TagController@formEditTag');
    Route::post('/edit-tag/{id?}', 'TagController@editTag');
    Route::get('/hapus-tag/{id?}', 'TagController@hapusTag');
});