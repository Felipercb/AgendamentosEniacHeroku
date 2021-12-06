
{{$semana}} - Selecione a seguir o horario de inicio e de fim do evento:<br>


@foreach ($horarios as $horario)
<button type="button" class="btn btn-primary mt-2 ms-1 me-1" id="{{$horario->id}}" onclick="button({{$horario->id}})">
    {{$horario->horarios}}
</button>
@endforeach


    <div class="d-flex justify-content-center mt-2">
    <button type="button" class="btn btn-danger" onclick="horario(1)">Limpar horários</button>
    </div>
    
