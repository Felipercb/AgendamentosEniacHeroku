<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        
        View::share ( 'admin', 0 );
        View::share ( 'suporte', 0 );

        if(Auth::check())
        {
            $finduser = Auth::user();//User::where('email', Auth::user()->email)->first();


            if ($request->is('configuracoes') && !$finduser->admin) {
                return redirect('/home')
                ->withErrors('Você não está autorizado a acessar essa página!');
            }
            
            if ($request->is('suporte') && (!$finduser->admin && !$finduser->suporte)) {
                return redirect('/home')
                ->withErrors('Você não está autorizado a acessar essa página!');
            }

            if($finduser->admin)
            {
                View::share ( 'admin', 1 );
            }
            if($finduser->suporte)
            {
                View::share ( 'suporte', 1 );
            }

        }
        return $next($request);
    }
}
