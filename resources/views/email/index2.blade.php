<h1> Agendamentos Eniac </h1>

<p> Olá {{$infoDestinatario->name}} seu agendamento foi realizado com sucesso, confira detalhes abaixo! </p>

<ul>
    <li>Nome do evento: {{$infoAgendamento->nome_evento}}</li>
    <li>Descrição: {{$infoAgendamento->obs}}</li>
    <li>Data: {{$data}}</li>
</ul>
<br>
<img src="{{ $message->embed(public_path() . '/qrcodeagendamento.png') }}"/>
<br>
<p>
    Confira essas e mais outras informações sobre o agendamento no 
    calendário do site (no caso de um agendamento público) ou na aba "Meus agendamentos"
    quando logado com o email que realizou o agendamento.
<p>
