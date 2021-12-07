<?php

namespace App\Http\Middleware;

use App\Models\agendamentos;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AgendamentoVerifyPrivate
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
        $hoje = Carbon::now();
        $agendamento = Agendamentos::where('id', $request->id)->get();
        
        if(!$agendamento->isEmpty())
        {

            if($agendamento[0]->publico == 1)
            {
                return $next($request);
            }
            else
            {

                $mensagem = "Esse ID de agendamento é privado, se for seu, visualize-o na aba 'Meus agendamentos'";

            }
        }
        else {

            $mensagem = "Esse ID não existe!";

        }
    

        return Redirect::to(URL::previous())->withErrors($mensagem);

    }
}
