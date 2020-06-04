<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
//use Illuminate\Cookie;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class RedirectIfAuthenticated
{

    public function handle($request, Closure $next, $guard = null)
    {

        $auth = Cookie::get('auth');
        if(!empty($auth)){
            $user = User::where("token",$auth)->first();
            if($user != null){
                $request->request->add(['companyData'=> null]);
                $request->request->add(['userData'=>$user]);
                View::share('user',$user);
                View::share('company',null);

            }else{
                $company = Company::where('token',$auth)->first();
                if($company != null){
                    $request->request->add(['companyData'=>$company]);
                    $request->request->add(['userData'=>null]);
                    View::share('user',null);
                    View::share('company',$company);
                }
                else{
                    $request->request->add(['companyData'=>null]);
                    $request->request->add(['userData'=>null]);
                    View::share('user',null);
                    View::share('company',null);
                }
            }

        }else{
            $request->request->add(['companyData'=>null]);
            $request->request->add(['userData'=>null]);
            View::share('user',null);
            View::share('company',null);
        }

        return $next($request);
    }
}
