
{{$semana}} - Selecione a seguir o horario de inicio e de fim do evento:<br>

@php ($flag = 0 )
@php ($flag1 = 0 )
@php ($index_ = 0 )

@foreach ($horarios as $horario)

    
    @if (!in_array($horario->index, $horarios_agendados2) )
    <button type="button" class="btn btn-primary mt-2 ms-1 me-1" id="{{$horario->id}}" onclick="button({{$horario->id}})">
        {{$horario->horarios}}
    </button>
    @endif

    @if (in_array($horario->index, $horarios_agendados2))
    <button type="button" class="btn btn-secondary mt-2 ms-1 me-1"  id="{{$horario->id}}" disabled>
        {{$horario->horarios}}
    </button>
    @endif


@endforeach


    <div class="d-flex justify-content-center mt-2">
        <button type="button" class="btn btn-danger" onclick="horario(1)">Limpar horários</button>
    </div>

