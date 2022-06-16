<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App; 
use Illuminate\Support\Facades\Auth;

class LanguageSwitch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $segment = $request->segment(1);
      // print_r(Config::get('app.langs'));
      // exit;
      if(empty($segment)) { // redirect '/' to default locale
        return redirect()->to('/' . config('app.langs'));

      }
      if($segment == 'id' || $segment == 'en'){
        if(in_array($segment, config('app.locales'))) {
          App::setLocale($segment);
          $request->except(0);

        }
        $request->route()->forgetParameter('locale');


        Session::put('language',config('app.langs'));
        Session::save();
        return $next($request);
      }else{
        return redirect('/'. app()->getLocale());
      }
    }
}
