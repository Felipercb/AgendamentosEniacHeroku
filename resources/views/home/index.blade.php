@extends('layout')

@section('cabecalho')

    Calendário de agendamentos ENIAC

    @section('erro')
        @include('erros', ['errors' => $errors])
    @endsection
    
@endsection

@section('conteudo')
<div class="d-flex justify-content-center p-5">
    <h3 class="mt-3 display-6">Calendário de agendamentos auditório ENIAC</h3>
</div>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

<div id='calendar'></div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {

        $('#calendar').fullCalendar({

            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dec'],
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'],

            buttonText: {
                today: 'Hoje'
            },
            timeFormat: 'H:mm',

            events : [
                @foreach($agendamentos as $agendamento)
                {
                    title : '{{ $agendamento->nome }}',
                    start : '{{ $agendamento->tempo_inicial }}',
                    url : "{{ route('detalhes', ['id' => $agendamento->id]) }}",
                    borderColor: 'white',
                },
                @endforeach
            ]
        })
    });
</script>

@endsection
