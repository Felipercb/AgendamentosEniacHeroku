@extends('layout')
 
@section('cabecalho')

    Alterar Agendamento

    @section('erro')
        @include('erros', ['errors' => $errors])
    @endsection

@endsection

@section('conteudo')
<div class="d-flex justify-content-center p-5">
    <h3 class="mt-3 display-6">Alterar Agendamento</h3>
</div>

<div class="container p-4 mt-1">
    <div class="row">
        <div class="col col-4 ">
            <h6>Recursos Áudio Visual:</h6>
        <form action="/agendar/editar/{{ $agendamento->id }}" method="post">
            @csrf
                <div class="container mb-2">
                    @foreach ($recAV as $recAV_)   
                        <div class="form-check mt-2">
                            <input class="form-check-input input-color" type="checkbox" name="recAv[]" id="recAV{{$recAV_->id}}" value="{{$recAV_->id}}" 
                                @foreach ( $agendamento->RecursosAudioVisuais as $recav)
                                    @if ($recav->id == $recAV_->id)
                                        checked
                                    @endif
                                @endforeach
                            >
                            <label class="form-check-label" for="recAV{{$recAV_->id}}">
                                {{$recAV_->nome}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col col-4 ">
                <h6>Serviços extras: </h6>
                <div class="container mb-2">
                    @foreach ($servEx as $servEx_)   
                        <div class="form-check mt-2">
                            <input class="form-check-input input-color" type="checkbox" name="servExID[]" id="servExID{{$servEx_->id}}" value="{{$servEx_->id}}"
                                @foreach ( $agendamento->ServicosExtras as $servex)
                                    @if ($servex->id == $servEx_->id)
                                        checked
                                    @endif
                                @endforeach
                            >
                            <label class="form-check-label" for="servExID{{$servEx_->id}}">
                                {{$servEx_->nome}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col col-4 ">
                <h6>Staff:</h6>
                <div class="container mb-2">
                    @foreach ($staff as $staff_)   
                        <div class="form-check mt-2">
                            <input class="form-check-input input-color" type="checkbox" name="staffID[]" id="staffID{{$staff_->id}}" value="{{$staff_->id}}"
                                @foreach ( $agendamento->Staff as $staff)
                                    @if ($staff->id == $staff_->id)
                                        checked
                                    @endif
                                @endforeach
                            >
                            <label class="form-check-label" for="staffID{{$staff_->id}}">
                                {{$staff_->nome}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="container mb-5">
                <label for="nome_evento" class="form-label"><h6>Nome do evento:</h6></label>
                <input type="text" class="form-control input-color-text" id="nome_evento"   name="nome_evento" value="{{$agendamento->nome}}">
            </div>

            <div class="container mb-5">
                <label for="obs" class="form-label"><h6>Descrição do evento:</h6></label>
                <input type="text" class="form-control input-color input-color-text" id="obs"   name="obs" value="{{$agendamento->descricao}}">
            </div>

            <div class="form-check mb-5">
                <input class="form-check-input input-color" type="checkbox" name="publico" id="publico" 
                
                    @if ($agendamento->publico == 1)
                        checked
                    @endif

                >
                <label class="form-check-label" for="publico">
                    Será um evento público? (Se essa opção for selecionada, o seu evento aparecerá na página de home)
                </label>
            </div>

            <button class="btn btn-success btn-verde">Salvar</button>
        </form>
    </div>
</div>
       


@endsection