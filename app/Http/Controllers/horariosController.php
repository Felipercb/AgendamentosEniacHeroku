<?php

namespace App\Http\Controllers;

use App\Models\agendamentos;
use App\Models\ConfiguracaoHorarios;
use App\Models\Horarios;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class horariosController extends Controller
{   
    private function diaSemana($data)
    {

        return date('w', strtotime($data));

    }

    public function index(Request $req)
    {
        $data = $req->data; //Recebo a data da pesquisa pela requisição

        $data2 = new DateTime($data); //Cria um objeto datetime que permite tratar data e horário
        $data2->add(new DateInterval("P1D"));//Pega o próximo dia de a cordo com a data atual
                                            //Isso será utilizado para fazer a condição de epsquisa no banco

        //Pesquisa na tabela agendamentos as datas que estão entre a $data e $data2 e ordena pelo horário inicial
        //Assim teremos a lista de agendamentos que ocorrem no mesmo dia, sendo oredenados pelo horário
        //O tratamento de como os botões de horários serão exibitos será feito no html
        $horarios = agendamentos::whereBetween('tempo_inicial' , [$data , $data2])->orderBy('tempo_inicial')->get();
        //dd($horarios);
        $idSemana = $this->diaSemana($data);
        $diasSemana = ["domingo" , "segunda-feira" , "terça-feira" , "quarta-feira" , "quinta-feira" , "sexta-feira" , "sábado" ];

        $disponibilidade_dia = ConfiguracaoHorarios::where('id_semana' , $idSemana)->get();
        
        if(!$disponibilidade_dia[0]->disponivel)
        {
            return "$diasSemana[$idSemana] não está aberto a agendamentos!";
        }
        
        $horarios_de_agendamentos = Horarios::where('dia_Semana' , $idSemana)->orderBy('index')->get();
        $ultimo_botao_index = count($horarios_de_agendamentos)-1;
        
        
        $botoes_desativados = [];//Lista dos index dos botões que devem ser desativados
        $primeiro_ultimo = [];//Lista que vai armazenar o primeiro horario e ultimo horário no período de agendamento
        $salvar_horario_temp = [];//Salvar temporariamente o horario atual no foreach

        $var_logica = 0; //Variável utilizada para a lógica
        
        foreach($horarios as $horario)//Roda todos os agendamentos do dia escolhido
        {   
            $inicio_agendamento = $horario->inicial_segundos; //Horario inicial do agendamento em segundos
            $fim_agendamento = $horario->final_segundos; //Horario final do agendamento em segundos


            foreach($horarios_de_agendamentos as $horario_agendamento) //Para cada agendamento, todos os botões serão verificados
            {
                $segundos_botao = $horario_agendamento->horario_segundos;//Horario do botão em segundos

                if( $segundos_botao >= $inicio_agendamento && $segundos_botao <= $fim_agendamento) //Se o botão atual estiver entre o horario inicial e o final 
                {
                    if($var_logica == 0){
                        array_push($primeiro_ultimo, $horario_agendamento); //Salva o primeiro horário da lista que está dentro do período de agendamento 
                        $var_logica = 1;//Muda a variável de lógica para 1, bloqueando apenas para o primeiro horário aparecer 
                    }
                    $salvar_horario_temp = $horario_agendamento;//Salva o atual em uma variável temporária

                    array_push($botoes_desativados, $horario_agendamento->index);

                }
                else if($var_logica == 1){
                    array_push($primeiro_ultimo, $salvar_horario_temp); //Salva o ultimo horário da lista que está dentro do período de agendamento
                    $var_logica = 2;
                }
            }

            if($primeiro_ultimo[0]->horario_segundos > $inicio_agendamento and $primeiro_ultimo[0]->index != 0 )
            {
                array_push($botoes_desativados, $primeiro_ultimo[0]->index-1);
            }
            if($primeiro_ultimo[1]->horario_segundos < $fim_agendamento and $primeiro_ultimo[1]->index != $ultimo_botao_index )
            {
                array_push($botoes_desativados, $primeiro_ultimo[1]->index+1);
            }
            $primeiro_ultimo = [];
            $var_logica = 0; //Variável utilizada para a lógica

        }


        if ($horarios->isEmpty())
        {   
            return view('botoes.index', [ "horarios" => $horarios_de_agendamentos,
            "semana" => $diasSemana[$idSemana],  ] );
        }
        else{
            return view('botoes.index2', [ "horarios" => $horarios_de_agendamentos,
            "semana" => $diasSemana[$idSemana], 
            "horarios_agendados2" => $botoes_desativados,
        ]); 
        }

        
    }
}
