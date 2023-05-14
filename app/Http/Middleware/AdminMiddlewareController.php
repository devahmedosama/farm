<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App;
use App\Models\UserPermission;
class AdminMiddlewareController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::guest()) {

            return redirect('/');
        }else{
            App::setLocale(Auth::User()->locale);
            $arr  =  request()->segments();
            $count = count($arr);
            $last  = intval($arr[$count-1]) ;

            $url  =  implode('/', $arr);
            if ($last > 0) {
                $url  =  str_replace('/'.$last, '', $url);
            }
            $url  =  str_replace('admin/', '', $url);
            if (count($arr) > 1 && Auth::User()->type != 0) {
                $per =  UserPermission::where('user_id',\Auth::id())
                            ->whereHas('permission',function($query) use($url){
                                    $query->where('url',$url);
                                })->first();
                if (empty($per)) {
                    return redirect('admin')
                              ->with('no',trans('home.You Don`t Have Permission'))
                            ;
                }
            }
        }
        return $next($request);
    }
}
