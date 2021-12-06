@extends('layout')

@section('cabecalho')

    Configurações

    @section('erro')
        @include('erros', ['errors' => $errors])
    @endsection

@endsection

@section('conteudo')

<div class="d-flex justify-content-center p-5">
    <h3 class="mt-3 display-6">Configurações da aplicação</h3>
</div>

<h5 id="teste" class="px-3">Locais:</h5>
<div class="container mb-5">
    <ul class="list-group">
        @foreach ($espacos as $espaco)   
            <li class="list-group-item d-flex justify-content-between align-items-center config-color">
                
               <span id="espaco_{{$espaco->id}}">{{$espaco->espaco}}</span>

                <div class="input-group w-55" hidden id="input_espaco_{{ $espaco->id }}">   
                    <input type="text" class="form-control input-color-text" value="{{$espaco->espaco}}" id="input_espaco_valor_{{ $espaco->id }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-editar" onclick="confirmarEdicao({{ $espaco->id }} , 'espaco')" >
                                <i class="fas fa-check"></i>
                            </button>
                            @csrf
                        </div>
                </div>


                <span class="d-flex">
                    <button class="btn btn-info btn-sm me-2" onclick="editar({{$espaco->id}} , 'espaco')" id="btn_editar_espaco_{{$espaco->id}}">
                        <i class="fas fa-edit"></i>
                    </button>

                    <button class="btn btn-danger btn-sm" onclick="remover({{$espaco->id}} , 'espaco')" id="btn_remover_espaco_{{$espaco->id}}">
                        <i class="fas fa-trash-alt"></i>
                    </button>   
                </span>   

            </li>
        @endforeach
        <li class="input-group list-group-item d-flex justify-content-between align-items-center config-color">
            <input type="text" class="form-control input-color-text"  id="input_espaco_valor">
            <button class="btn btn-primary" onclick="adicionar('input_espaco_valor' , 'espaco')">
                <i class="far fa-plus-square"></i>
            </button>
        </li>
    </ul>
</div>

<div class="row mb-5">
    <div class="col col-4 ">
        <h5>Recursos Áudio Visuais:</h5>
        <ul class="list-group ">
            @foreach ($recAV as $recAV_)  

            <li class="list-group-item d-flex justify-content-between align-items-center config-color">  

                <span id="recAv_{{$recAV_->id}}">{{$recAV_->nome}}</span>

                <div class="input-group w-55" hidden id="input_recAv_{{$recAV_->id}}">   
                    <input type="text" class="form-control input-color-text" value="{{$recAV_->nome}}" id="input_recAv_valor_{{$recAV_->id}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="confirmarEdicao({{ $recAV_->id }} , 'recAv')" >
                                <i class="fas fa-check"></i>
                            </button>
                            @csrf
                        </div>
                </div>

            <span class="d-flex">
                <button class="btn btn-info btn-sm me-2" onclick="editar({{$recAV_->id}} , 'recAv')" , id="btn_editar_recAv_{{$recAV_->id}}">
                    <i class="fas fa-edit"></i>
                </button> 

                <button class="btn btn-danger btn-sm" onclick="remover({{$recAV_->id}} , 'recAv')" id="btn_remover_recAv_{{$recAV_->id}}">
                    <i class="fas fa-trash-alt"></i>
                </button>   
            </span> 


            </li>
            @endforeach

            <li class="input-group list-group-item d-flex justify-content-between align-items-center config-color">
                <input type="text" class="form-control input-color-text"  id="input_recAv_valor">
                <button class="btn btn-primary" onclick="adicionar('input_recAv_valor' , 'recAv')">
                    <i class="far fa-plus-square"></i>
                </button>
            </li>

        </ul>
    </div>

    <div class="col col-4 ">
        <h5>Serviços extras: </h5>
        <ul class="list-group">
            @foreach ($servEx as $servEx_)  
            <li class="list-group-item d-flex justify-content-between align-items-center config-color"> 


                <span id="servEx_{{$servEx_->id}}">{{$servEx_->nome}}</span>

                <div class="input-group w-55" hidden id="input_servEx_{{ $servEx_->id }}">   
                    <input type="text" class="form-control input-color-text" value="{{$servEx_->nome}}" id="input_servEx_valor_{{$servEx_->id}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="confirmarEdicao({{ $servEx_->id }} , 'servEx')" >
                                <i class="fas fa-check"></i>
                            </button>
                            @csrf
                        </div>
                </div>


                <span class="d-flex">
                    <button class="btn btn-info btn-sm me-2" onclick="editar({{$servEx_->id}} , 'servEx')"  id="btn_editar_servEx_{{$servEx_->id}}">
                        <i class="fas fa-edit"></i>
                    </button>

                    <button class="btn btn-danger btn-sm" onclick="remover({{$servEx_->id}} , 'servEx')" id="btn_remover_servEx_{{$servEx_->id}}">
                        <i class="fas fa-trash-alt"></i>
                    </button>   
                </span> 


            </li>
            @endforeach
            <li class="input-group list-group-item d-flex justify-content-between align-items-center config-color">
                <input type="text" class="form-control input-color-text""  id="input_servEx_valor">
                <button class="btn btn-primary" onclick="adicionar('input_servEx_valor' , 'servEx')">
                    <i class="far fa-plus-square"></i>
                </button>
            </li>
        </ul>
    </div>

    <div class="col col-4 ">
        <h5>Staff:</h5>
        <ul class="list-group">
            @foreach ($staff as $staff_)  
            <li class="list-group-item d-flex justify-content-between align-items-center config-color"> 

                <span id="staff_{{$staff_->id}}">{{$staff_->nome}}</span>

                <div class="input-group w-55" hidden id="input_staff_{{ $staff_->id }}">   
                    <input type="text" class="form-control input-color-text" value="{{$staff_->nome}}" id="input_staff_valor_{{$staff_->id}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="confirmarEdicao({{ $staff_->id }} , 'staff')" >
                                <i class="fas fa-check"></i>
                            </button>
                            @csrf
                        </div>
                </div>


                <span class="d-flex">
                    <button class="btn btn-info btn-sm me-2" onclick="editar({{$staff_->id}} , 'staff')" id="btn_editar_staff_{{$staff_->id}}">
                        <i class="fas fa-edit"></i>
                    </button>

                    <button class="btn btn-danger btn-sm" onclick="remover({{$staff_->id}} , 'staff')" id="btn_remover_staff_{{$staff_->id}}">
                        <i class="fas fa-trash-alt"></i>
                    </button>   
                </span> 


            </li>
            @endforeach

            <li class="input-group list-group-item d-flex justify-content-between align-items-center config-color">
                <input type="text" class="form-control input-color-text"  id="input_staff_valor">
                <button class="btn btn-primary" onclick="adicionar('input_staff_valor' , 'staff')">
                    <i class="far fa-plus-square"></i>
                </button>
            </li>
            
        </ul>

    </div>
</div>

<div class="mb-5"><h5>Configuração de horários por dia da semana:</h5></div>
<div class="row mb-2">
    <div class="col col-2 ">
        Escolha um dia para configurar:<br><br>
        <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownDiaSemana" data-bs-toggle="dropdown" aria-expanded="false">
              Domingo
            </button>
            <ul class="dropdown-menu input-color" aria-labelledby="dropdownDiaSemana">
              <li><a class="dropdown-item" onclick="diaSemana(0, 'Domingo')">Domingo</a></li>
              <li><a class="dropdown-item" onclick="diaSemana(1 , 'Segunda')">Segunda</a></li>
              <li><a class="dropdown-item" onclick="diaSemana(2 , 'Terça')">Terça</a></li>
              <li><a class="dropdown-item" onclick="diaSemana(3 , 'Quarta')">Quarta</a></li>
              <li><a class="dropdown-item" onclick="diaSemana(4 , 'Quinta')">Quinta</a></li>
              <li><a class="dropdown-item" onclick="diaSemana(5 , 'Sexta')">Sexta</a></li>
              <li><a class="dropdown-item" onclick="diaSemana(6 , 'Sábado')">Sábado</a></li>
            </ul>
        </div>
    </div>
    <div class="col col-4 ">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center config-color">
                Horário de abertura:
                <input type="time" class="form-control input-color-text"  id="timeAbertura" value="{{$config_horarios[0]->abertura}}"  >
                
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center config-color">
                Horário de fechamento: 
                <input type="time" class="form-control input-color-text"  id="timeFechamento" value="{{$config_horarios[0]->fechamento}}">
                
            </li>
        </ul>
    </div>
    <div class="col col-4 ">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center config-color">
                Período de horários:<br>
                <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownPeriodo" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($config_horarios[0]->periodo == '00:15:00')
                            15 minutos
                            <script>periodo_ = 0;</script>
                        @elseif ($config_horarios[0]->periodo == '00:30:00')
                            30 minutos
                            <script>periodo_ = 1;</script>
                        @elseif ($config_horarios[0]->periodo == '01:00:00')
                            1 hora
                            <script>periodo_ = 2;</script>
                    @endif
                    </button>
                    <ul class="dropdown-menu input-color" aria-labelledby="dropdownPeriodo">
                    <li><a class="dropdown-item" onclick="periodo(0, '15 minutos')">15 minutos</a></li>
                    <li><a class="dropdown-item" onclick="periodo(1 , '30 minutos')">30 minutos</a></li>
                    <li><a class="dropdown-item" onclick="periodo(2 , '1 hora')">1 hora</a></li>
                    </ul>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center config-color">
                O espaço estará disponível nesse dia?
                <div class="form-check p-2">
                    <input class="form-check-input input-color" type="radio" name="flexRadioDisponibilidadeDia" id="flexRadioDiaDisponivel">
                    <label class="form-check-label" for="flexRadioDiaDisponivel">
                      Sim
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input input-color" type="radio" name="flexRadioDisponibilidadeDia" id="flexRadioDiaIndisponivel" >
                    <label class="form-check-label" for="flexRadioDiaIndisponivel">
                      Não
                    </label>
                  </div>
            </li>
    </div>

    
</div>


<div class="col col-4 ">
    <br><br>
    <button class="btn btn-success btn-lg btn-verde" type="button" id="salvarHorario" onclick="salvarHorario({{$config_horarios[0]->id}})">
        Salvar horários
    </button>
    
</div>

<br>
<br>
<script>
    var1 = '';
    var2 = '';
    var3 = '';
    var4 = '';
    var token; 

    function editar(id , tipo)
    {
        console.log(tipo);

        var1 = `${tipo}_${id}`;
        var2 = `btn_editar_${tipo}_${id}`;
        var3 = `input_${tipo}_${id}`;
        var4 = `btn_remover_${tipo}_${id}`;

        document.getElementById(var1).hidden = true;
        document.getElementById(var2).hidden = true;
        document.getElementById(var4).hidden = true;
        document.getElementById(var3).removeAttribute('hidden');
    }

    function confirmarEdicao(id, tipo)
    {
        var modificar = true;

        var valor = document.querySelector(`#input_${tipo}_${id} > input`).value;
        valor_antigo = document.getElementById(`${tipo}_${id}`).textContent;

        if(valor_antigo == valor){
                document.getElementById(var3).hidden = true;
                document.getElementById(var2).removeAttribute('hidden');
                document.getElementById(var1).removeAttribute('hidden');
                document.getElementById(var4).removeAttribute('hidden');
        modificar = false;

        }


        if(modificar){
        let formData = new FormData(); //Vai ser um fomulario enviado pelo javascript
        formData.append('tipo', tipo); 
        formData.append('id', id); 
        formData.append('valor', valor); 
        formData.append('forma', 'modificar'); 
        formData.append('_token', document.querySelector(`input[name="_token"]`).value); 
        
        fetch(document.URL, {
        method: 'POST', 
        body: formData
        }).then(() => {
           document.location.reload(true);
        });
        }
    }

    function adicionar(obj, tipo){
        confirmacao = confirm("Tem certeza que deseja adicionar algo?")

        if(confirmacao)
        {
            valor = document.getElementById(obj).value;

            let formData = new FormData(); //Vai ser um fomulario enviado pelo javascript
            formData.append('_token', document.querySelector(`input[name="_token"]`).value); 
            formData.append('tipo', tipo); 
            formData.append('valor', valor); 
            formData.append('forma', 'adicionar'); 

            fetch(document.URL, {
            method: 'POST', 
            body: formData
            }).then(() => {
            document.location.reload(true);
            });
        }
    }

    function remover(id, tipo)
    {

        confirmacao = confirm("Tem certeza que deseja deletar?")

        if(confirmacao)
        {
            let formData = new FormData(); //Vai ser um fomulario enviado pelo javascript
            formData.append('_token', document.querySelector(`input[name="_token"]`).value); 
            formData.append('tipo', tipo); 
            formData.append('id', id); 
            formData.append('forma', 'remover'); 
            
            fetch(document.URL, {
            method: 'POST', 
            body: formData
            }).then(() => {
            document.location.reload(true);
            });
        }
        
    }

    function periodo(val, texto)
    {   
        periodo_ = val;
        document.getElementById("dropdownPeriodo").textContent = texto;
    }

    function salvarHorario(idconfig)
    {
        confirmacao = confirm("Tem certeza que deseja modificar os horários? Essa alteração irá mudar toda a forma como os agendamentos funcionam. (Agendamentos que já foram feitos não serão afetados). ")

        if(confirmacao)
        {
            let formData = new FormData(); //Vai ser um fomulario enviado pelo javascript
            formData.append('_token', document.querySelector(`input[name="_token"]`).value); 
            formData.append('timeAbertura', document.getElementById("timeAbertura").value); 
            formData.append('timeFechamento', document.getElementById("timeFechamento").value); 
            formData.append('periodo', periodo_); 
            formData.append('forma', 'horarios'); 
            formData.append('idconfig', idconfig); 
            formData.append('idSemana', idSemana); 
            formData.append('diaDisponivel', document.getElementById("flexRadioDiaDisponivel").checked); 
            
            fetch(document.URL, {
            method: 'POST', 
            body: formData
            }).then(() => {
            document.location.reload(true);
            });
        }
    }

    var idSemana = 0;

    var json_config_horario = JSON.parse(' @json( $config_horarios )' );
    if(json_config_horario[0].disponivel == 1)
    {
        document.getElementById("flexRadioDiaDisponivel").checked = true ;
    }
    else{
        document.getElementById("flexRadioDiaIndisponivel").checked = true ;
    }

    function diaSemana(num, texto)
    {
        idSemana = num;
        document.getElementById("timeAbertura").value = json_config_horario[num].abertura ;
        document.getElementById("timeFechamento").value = json_config_horario[num].fechamento;
        document.getElementById("dropdownDiaSemana").textContent = texto;
        switch(json_config_horario[num].periodo)
        {
            case '00:15:00': textoPasso = "15 minutos"; break;
            case '00:30:00': textoPasso = "30 minutos"; break;
            case '01:00:00': textoPasso = "1 hora"; break;
        }

        if(json_config_horario[num].disponivel == 1)
        {
            document.getElementById("flexRadioDiaDisponivel").checked = true ;
        }
        else{
            document.getElementById("flexRadioDiaIndisponivel").checked = true ;
        }
             
   
        document.getElementById("dropdownPeriodo").textContent = textoPasso;
    }

</script>

@endsection