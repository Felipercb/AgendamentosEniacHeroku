<?php

namespace App\Http\Middleware;

use App\Models\agendamentos;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AgendamentoVerifyUser
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
        $agendamento = Agendamentos::where("id" , $request->id)->get();

        if(!$agendamento->isEmpty()) 
        {
            if($agendamento[0]->email_conta ==  Auth::user()->email)
            {
                return $next($request);
            }
            else
            {
                $mensagem = "Voce não tem permissão para editar esse agendamento!"; 
            }
        }
        else
        {
            $mensagem = "Esse agendamento não existe!";
        }

        return Redirect::to(URL::previous())->withErrors($mensagem);

    }
}
