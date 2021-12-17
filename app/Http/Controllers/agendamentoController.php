<?php

namespace App\Http\Controllers;

use App\Http\Helper\conversorHorariosSegundos;
use App\Http\Requests\agendamentosFormRequest;
use App\Mail\EmailAgendamento;
use App\Mail\EmailAgendamento2;
use App\Models\{agendamentos, Espacos, Horarios, RecAudioVisuais, ServicosExtras, staff, Mensagem, User};
use App\Services\criadorAgendamentos;
use App\Services\removedorAgendamentos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class agendamentoController extends Controller
{
    public function index()
    {

        $espacos = Espacos::query()->orderBy('espaco')->get();
        $recAV = RecAudioVisuais::query()->orderBy('nome')->get();
        $servEx = ServicosExtras::query()->orderBy('nome')->get();
        $staff = Staff::query()->orderBy('nome')->get();
        $dateNow = Carbon::now();


        return view('agendar.index', [
            'espacos' => $espacos, 
            'recAV' => $recAV,
            'servEx' => $servEx,
            'staff' => $staff,
            'dateNow' => $dateNow
        ]);
    }
    public function store(agendamentosFormRequest /*Request*/ $req, criadorAgendamentos $agendar )
    {
        
        $data = $req->data;
        $dataAjuste = explode("-", $data);
        $dataBR = $dataAjuste[2] ."/". $dataAjuste[1] ."/". $dataAjuste[0];
        
        $email1 = $req->email;
        $email2 = Auth::user()->email;

        // Criação de agendamento
        $id_agendamento = $agendar->criarAgendamento($req);
        
        // Requisição POST para API do Qrcode

        $qrcode = Http::post('https://geradorqrcode.herokuapp.com/post', [
            'nome' => $req->nome,
            'evento' => $req->nome_evento,
            'descricao' => $req->obs,
        ]);

        //$qrcode = response($qrcode)->header('Content-Type', 'image/png');
        // Salvando imagem no Public
        define('UPLOAD_DIR', 'qrcode');
        $img = $qrcode;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . 'agendamento' . '.png';
        file_put_contents($file, $data);

        
        $qrcode = $file;
        // Envio de Email
        if($email1 == $email2) {
            Mail::to($email1)->send(new EmailAgendamento($req, $dataBR, $qrcode));
        } else {
            Mail::to($email1)->send(new EmailAgendamento($req, $dataBR, $qrcode));
            Mail::to($email2)->send(new EmailAgendamento2(Auth::user(), $req, $dataBR, $qrcode));
        }

        //Envio de Mensagem no Telegram
        $url = route('suporte_consulta', ['id' => $id_agendamento]);
        Mensagem::sendMessage("<b>Evento: </b>" . $req->nome_evento . "\n" . "<b>Agendado para: </b>". $dataBR . "\n" . "<b>Responsável: </b>" . $req->nome . "\n\n" . "Para se responsabilizar pelo evento, clique no link abaixo: " . "\n" . "<a href ='" . $url . "'>Se responsabilizar!</a>");

        return redirect()->route('home');
    }

    public function destroy(Request $req, removedorAgendamentos $remover_agendamento)
    {
        $remover_agendamento->apagarAgendamento($req->id);
        $req->session()->flash('mensagem' , "Agendamento Nº $req->id removido com sucesso!.");
        return redirect()->route('meusagendamentos');
    }

    public function edit(Request $req)
    {   
        $agendamento = Agendamentos::where("id" , $req->id)->get();

        $recAV = RecAudioVisuais::query()->orderBy('nome')->get();
        $servEx = ServicosExtras::query()->orderBy('nome')->get();
        $staff = Staff::query()->orderBy('nome')->get();

        return view('agendar.edit',[
        'agendamento' =>  $agendamento[0],
        'recAV' => $recAV,
        'servEx' => $servEx,
        'staff' => $staff
        ]);
    }

    public function salvarMudancas(Request $request) {
        DB::beginTransaction();
        $agendamento_id = $request->id;
        $nomeEvento = $request->nome_evento;
        $descricao = $request->obs;
        $publico = $request->publico;
    
        $agendamento = Agendamentos::find($agendamento_id);
        $agendamento->RecursosAudioVisuais()->detach();
        $agendamento->ServicosExtras()->detach();
        $agendamento->Staff()->detach();
        
        $altera = Agendamentos::find($agendamento_id);
        $altera->nome = $nomeEvento;
        $altera->descricao = $descricao;
        $altera->publico = $publico == "on";
        $altera->save();

        if ($request->has(['recAv'])) {
            $recAVID = $request->recAv;
            foreach($recAVID as $recAVID_)
            {
               $recursosAudioVisuais = $agendamento->RecursosAudioVisuais()->attach([
                 'recaudiovisuais_id' => $recAVID_
               ]);
            }
        } 
        
        if($request->has(['servExID'])) {
            $servEx = $request->servExID;
            foreach($servEx as $servEx_)
            {
               $servicosExtras = $agendamento->ServicosExtras()->attach([
                 'servicosextras_id' => $servEx_
               ]);
            }
        }

        if($request->has(['staffID'])) {
            $staff = $request->staffID;
            foreach($staff as $staff_)
            {
               $staff__ = $agendamento->Staff()->attach([
                 'staff_id' => $staff_
               ]);
            }
        }
        DB::commit(); 

        return redirect()->route('meusagendamentos');
    }
}