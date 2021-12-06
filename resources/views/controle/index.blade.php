@extends('layout')

@section('cabecalho')

    Agendamentos auditório ENIAC

    @section('erro')
        @include('erros', ['errors' => $errors])
    @endsection
    
@endsection

@section('conteudo')
<div class="d-flex justify-content-center p-5">
    <h3 class="mt-3 display-6">Acompanhe os agendamentos realizados:</h3>
</div>

@foreach ($agendamentos as $agendamento)
    
    @if($agendamento->tempo_inicial >= $hoje)

        <ul class="list-group list-group-flush ul-itens-agendamentos" id="list-group-{{$agendamento->id}}">
            <li class="list-group-item itens-agendamentos" id="list-group-item-{{$agendamento->id}}">
                <button class="btn btn-primary btn-abrir-fechar" onclick="criarEquipe(1, {{$agendamento->id}})" id="btn_criar_equipe{{$agendamento->id}}">
                    <i class="fas fa-plus-square"> Abrir</i>
                </button>
                <button class="btn btn-primary btn-abrir-fechar" onclick="criarEquipe(0, {{$agendamento->id}})" id="btn_criar_equipe_menos{{$agendamento->id}}" hidden>
                    <i class="fas fa-minus-square"> Fechar</i>
                </button>
                <span class="align-middle display-1 p-2" style="font-size: 20px;"><b style="display:inline-block; margin-top: 12px;">Nome do Evento:</b> {{$agendamento->nome}} / <b>Local:</b> {{$agendamento->Espacos[0]->espaco}}</span>
                <div class="d-flex justify-content-between ">
                    <p class="display-1" style="font-size: 12px;margin-bottom: -2px;margin-left: 8px;margin-top: 3px;">Data: {{$agendamento->tempo_inicial->format("d/m/o")}}</p>
                    <p class="display-1" style="font-size: 13px;margin-bottom: -2px;"> Responsável: {{$agendamento->responsavel->nome}}</p>
                </div>
            </li>
            <div class="row p-3" id="agendamento-{{$agendamento->id}}" hidden>
                <div class="col col-4 p-1">
                    <span class="titulo-agendamento">Informações do agendamento:</span>
                    <ul id="lista" class="list-group list-group-flush">
                        <li class="list-group-item conteudo-agendamento">Data: {{$agendamento->tempo_inicial->format("d/m/o")}}  </li>
                        <li class="list-group-item conteudo-agendamento">Inicio: {{$agendamento->tempo_inicial->format("H:i:s")}} </li>
                        <li class="list-group-item conteudo-agendamento">Nome: {{$agendamento->nome}} </li>
                        <li class="list-group-item conteudo-agendamento">Descrição: {{$agendamento->descricao}} </li>
                        <li class="list-group-item conteudo-agendamento">Local: {{$agendamento->Espacos[0]->espaco}}  </li>
                        <li class="list-group-item conteudo-agendamento">Fim:  {{$agendamento->tempo_final->format("H:i:s")}}</li>
                    </ul>
                </div>
                <div class="col col-4 p-1">
                    <span class="titulo-agendamento">Informações do responsável:</span>
                    <ul id="lista" class="list-group list-group-flush">
                        <li class="list-group-item conteudo-agendamento">Nome: {{$agendamento->responsavel->nome}}</li>
                        <li class="list-group-item conteudo-agendamento">Telefone: {{$agendamento->responsavel->telefone}}</li>
                        <li class="list-group-item conteudo-agendamento">Email: {{$agendamento->responsavel->email}}</li>
                    </ul>
                </div>
                <div class="col col-2 p-1">
                    <span class="titulo-agendamento">Informações extras:</span>
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
                <div class="col col-1 p-1 align-self-end">
                    @auth
                        @if ($agendamento->email_conta == Auth::user()->email)
                            <form action="/agendar/editar/{{$agendamento->id}}" method="get">
                                <button class="btn btn-primary btn-sm btn-editar" action="/teste" >
                                    <i class="fas fa-edit"></i>
                                    <span class="text-light"><small>(Editar)</small></span>
                                </button>
                                
                            </form>

                        @endif
                    @endauth
                </div>
                <div class="col col-1 p-1 align-self-end">
                    @auth
                        @if ($agendamento->email_conta == Auth::user()->email)

                            <form action="/agendar/remover/{{$agendamento->id}}" method="post" onsubmit="return confirm('Tem certeza que quer excluir o agendamento número {{$agendamento->id}}?')">
                                @csrf
                                <button class="btn btn-danger btn-sm btn-vermelho">
                                    <i class="fas fa-trash-alt"></i>
                                    <span class="text-light"><small>(Excluir)</small></span>
                                </button>     
                            </form>
                            
                        @endif
                    @endauth
                </div>
            </div>
        </ul>
    @endif
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
