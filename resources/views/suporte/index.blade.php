@extends('layout')

@section('cabecalho')

    Página do suporte

    @section('erro')
        @include('erros', ['errors' => $errors])
    @endsection
    
@endsection

@section('conteudo')
<div class="d-flex justify-content-center p-5">
    <h3 class="mt-3 display-6">Área de suporte</h3>
</div>

<h4>Solicitações da semana:</h4>


@foreach ($agendamentos as $agendamento)
    
    @if (empty($agendamento->suporte_id))
        <ul class="list-group list-group-flush ul-itens-agendamentos-red" id="list-group-{{$agendamento->id}}">
    @else
        <ul class="list-group list-group-flush ul-itens-agendamentos" id="list-group-{{$agendamento->id}}">
    @endif
        <li class="list-group-item itens-agendamentos" id="list-group-item-{{$agendamento->id}}">
            <button class="btn btn-primary btn-abrir-fechar" onclick="criarEquipe(1, {{$agendamento->id}})" id="btn_criar_equipe{{$agendamento->id}}">
                <i class="fas fa-plus-square"> Abrir</i>
            </button>
            <button class="btn btn-primary btn-abrir-fechar" onclick="criarEquipe(0, {{$agendamento->id}})" id="btn_criar_equipe_menos{{$agendamento->id}}" hidden>
                <i class="fas fa-minus-square"> Fechar</i>
            </button>
            <span class="align-middle display-1 p-2" style="font-size: 20px;">
                <b>LOCAL: </b>{{$agendamento->Espacos[0]->espaco}} / 
                <b style="display:inline-block; margin-top: 12px;">DATA:</b> {{$agendamento->tempo_inicial->format("d/m/o")}} / 
                <b>HORÁRIO:</b> {{$agendamento->tempo_inicial->format("H:i:s")}} até {{$agendamento->tempo_final->format("H:i:s")}}
            <div class="d-flex justify-content-center">
                <p class="display-1" style="font-size: 13px;margin-bottom: -20px;">
                    @foreach ($suportes as $suporte)

                        @if ($agendamento->suporte_id == $suporte->id)
                            Suporte Responsável: {{$suporte->name}}
                        @elseif(empty($agendamento->suporte_id))
                            Não há suporte responsável @break
                        @endif

                    @endforeach
                </p>
            </div>
            </span>
        </li>
            <div class="row justify-content-center p-3" id="agendamento-{{$agendamento->id}}" hidden>
                <div class="col col-5 p-1">
                    <span class="titulo-agendamento">Recursos Solicitados:</span>
                    <ul id="lista"  class="list-group list-group-flush">
                        @foreach ($agendamento->RecursosAudioVisuais as $audioVisual)
                            <li class="list-group-item conteudo-agendamento">{{$audioVisual->nome }} </li>
                        @endforeach

                        @foreach ($agendamento->ServicosExtras as $ServicosExtras)
                            <li class="list-group-item conteudo-agendamento">{{$ServicosExtras->nome }} </li>
                        @endforeach
                        
                        @foreach ($agendamento->Staff as $Staff)
                        <li class="list-group-item conteudo-agendamento">{{$Staff->nome }} </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col col-5 p-1">
                    <span class="titulo-agendamento">Informações do agendamento:</span>
                    <ul id="lista" class="list-group list-group-flush">
                        <li class="list-group-item conteudo-agendamento">Nome: {{$agendamento->nome}} </li>
                        <li class="list-group-item conteudo-agendamento">Descrição: {{$agendamento->descricao}} </li>
                        <li class="list-group-item conteudo-agendamento">Data: {{$agendamento->tempo_inicial->format("d/m/o")}}  </li>
                        <li class="list-group-item conteudo-agendamento">Inicio: {{$agendamento->tempo_inicial->format("H:i:s")}} </li>
                        <li class="list-group-item conteudo-agendamento">Fim:  {{$agendamento->tempo_final->format("H:i:s")}}</li>
                        <li class="list-group-item conteudo-agendamento">Local: {{$agendamento->Espacos[0]->espaco}}  </li>
                    </ul>
                </div>
            
                @if (empty($agendamento->suporte_id))
                    <div class="col col-1 p-1 align-self-end">
                        <form action="/suporte/responsavel/{{$agendamento->id}}" method="post" onsubmit=" return confirm('Deseja mesmo se responsabilizar pelo agendamento {{$agendamento->id}}?')">
                            @csrf
                            <button class="btn btn-primary btn-sm btn-editar">
                                <i class="fas fa-edit"></i>
                                <span class="text-light"><small>Se responsabilizar</small></span>
                            </button>    
                        </form>
                    </div>
                @endif

                @if ($agendamento->suporte_id == Auth::user()->id)
                    <div class="col col-1 p-1 align-self-end">
                        <form action="/suporte/remover/{{$agendamento->id}}" method="post"  onsubmit=" return confirm('Deseja mesmo remover sua responsabilidade sobre o agendamento {{$agendamento->id}}? Tenha certeza de que outro suporte irá cuidar desse agendamento!')">
                            @csrf
                            <button class="btn btn-primary btn-sm btn-editar">
                                <i class="fas fa-edit"></i>
                                <span class="text-light"><small>Remover responsabilidade</small></span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </ul>
@endforeach

<script>
    function criarEquipe(tipo, id)
    {
        agendamentoId = document.getElementById('agendamento-'+id);
        btn_criar_mais = document.getElementById('btn_criar_equipe'+id)
        btn_criar_menos = document.getElementById('btn_criar_equipe_menos'+id)

        if(tipo)
        {
            btn_criar_mais.hidden = true;
            btn_criar_menos.removeAttribute('hidden');
            agendamentoId.removeAttribute('hidden');
        }
        else
        {
            btn_criar_mais.removeAttribute('hidden');
            btn_criar_menos.hidden = true;
            agendamentoId.hidden = true;
        }
    }
</script>
@endsection