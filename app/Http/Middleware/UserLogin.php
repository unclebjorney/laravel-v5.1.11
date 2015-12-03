<?php
/**
 * Created by PhpStorm.
 * User: LJ
 * Date: 2015/12/2
 * Time: 10:36
 */

namespace App\Http\Middleware;

use Closure;

class UserLogin {
    public function handle($request, Closure $next) {
        if(!session()->has('currentUser')) {
            return redirect('view/bupt/user/login');
        }
        return $next($request);
    }
}
