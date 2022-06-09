<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\School\Item as School;

class SchoolMiddleware
{
    /**
     * Имеет ли текущий Пользователь аккаунт школы
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next )
    {   
        # проверяем создана ли школа у текущего пользователя
        $school = School::where("user_id", auth()->user()->id)->first();
        
        if( is_null($school) ){
            return \Redirect::to("/account/profile/create", 302);
        }

        return $next($request);

    }
}
