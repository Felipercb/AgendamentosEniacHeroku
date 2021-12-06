@extends('layout')

@section('cabecalho')

    Agendamento auditório ENIAC

    @section('erro')
        @include('erros', ['errors' => $errors])
    @endsection

@endsection

@section('conteudo')
<div class="d-flex justify-content-center p-5">
    <h3 class="mt-3 display-6">Criação de agendamento</h3>
</div>
    <form method="post" >
        @csrf
    <div class="tab">
        <p style="font-size: 12px">Dados do responsável pelo agendamento: </p>
                <div class="container mb-5 mt-2">
                    <div class="row">
                        <div class="col col-5">
                            <label for="nome" class="form-label">*Nome:</label>
                            <input type="text" class="form-control input-color-text" id="nome" name="nome" value="{{ old('nome') }}">
                        </div>

                        <div class="col col-3">
                            <label for="email" class="form-label">*Email:</label>
                            <input type="email" class="form-control input-color-text" id="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="col col-3">
                            <label for="telefone" class="form-label">*Telefone</label>
                            <input type="text" class="form-control input-color-text" id="telefone" name="telefone" value="{{ old('telefone') }}">
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <p class="mt-3" style="font-size: 11px">*campo obrigatório</p>
                        </div>
                    </div>
                </div>
    </div>


    <div class="tab">
                <div class="container mb-5">
                    <label for="data" class="form-label">Selecione a data em que o evento irá acontecer:</label>
                    <input type="date" class="form-control input-color-text" id="data"   name="data" value="{{ old('data') }}">
                    <button type="button" class="btn btn-success mt-4 btn-verde" onclick="horario(0)" >Verificar</button>
                </div>

                <p>
                    <p id="demo"></p>
                </p> 

                <input type="text" name="horarios" id="horarios" hidden  > 
    </div>

   
    <div class="tab">
                *Local:
                <div class="container mb-5">
                    @foreach ($espacos as $espaco)   
                    <div class="form-check mt-2">
                        <input class="form-check-input input-color" type="radio" name="espacoID" id="espacoID{{$espaco->id}}" value="{{$espaco->id}}" >
                        <label class="form-check-label" for="espacoID{{$espaco->id}}">
                            {{$espaco->espaco}} 
                        </label>
                    </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col col-4 ">
                        Recursos Áudio Visual:
                        <div class="container mb-2">
                            @foreach ($recAV as $recAV_)   
                            <div class="form-check mt-2">
                                <input class="form-check-input input-color" type="checkbox" name="recAVID[]" id="recAVID{{$recAV_->id}}" value="{{$recAV_->id}}">
                                <label class="form-check-label" for="recAVID{{$recAV_->id}}">
                                    {{$recAV_->nome}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col col-4 ">
                        Serviços extras: 
                        <div class="container mb-2">
                            @foreach ($servEx as $servEx_)   
                            <div class="form-check mt-2">
                                <input class="form-check-input input-color" type="checkbox" name="servExID[]" id="servExID{{$servEx_->id}}" value="{{$servEx_->id}}">
                                <label class="form-check-label" for="servExID{{$servEx_->id}}">
                                    {{$servEx_->nome}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col col-4 mb-2">
                        Staff:
                        <div class="container mb-2">
                            @foreach ($staff as $staff_)   
                            <div class="form-check mt-2">
                                <input class="form-check-input input-color" type="checkbox" name="staffID[]" id="staffID{{$staff_->id}}" value="{{$staff_->id}}">
                                <label class="form-check-label" for="staffID{{$staff_->id}}">
                                    {{$staff_->nome}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="container mb-5">
                    <label for="nome_evento" class="form-label">*Nome do evento:</label>
                    <input type="text" class="form-control input-color-text" id="nome_evento"   name="nome_evento">
                </div>

                <div class="container mb-5">
                    <label for="obs" class="form-label">*Descrição do evento:</label>
                    <input type="text" class="form-control input-color-text" id="obs"   name="obs">
                </div>

                <div class="form-check">
                    <input class="form-check-input input-color" type="checkbox" name="publico" id="publico" >
                    <label class="form-check-label" for="publico">
                        Será um evento público? (Se essa opção for selecionada, o seu evento aparecerá na página de home)
                    </label>
                </div>
                <div class="d-flex flex-row-reverse">
                    <p class="mt-3" style="font-size: 11px">*campo obrigatório</p>
                </div>
    </div>

        <button class="btn btn-success btn-verde" type="submit" id="enviar" hidden>Enviar</button>
    </form>

    <div style="overflow:auto;">
        <div style="float:right;">
          <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-primary btn-proximo-voltar">Voltar</button>
          <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-primary btn-proximo-voltar">Próximo</button>
        </div>
    </div>
      

    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
      </div>


<script>

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) 
    {        
            verificarContinuar();
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
               // document.getElementById("nextBtn").innerHTML = "Submit";
                document.getElementById("nextBtn").style.display = "none";
                document.getElementById("enviar").removeAttribute("hidden");
            } else {
                document.getElementById("nextBtn").innerHTML = "Próximo";
                document.getElementById("nextBtn").style.display = "inline";
                document.getElementById("enviar").hidden = true;
            }
            
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n)
    }

    function nextPrev(n) 
    {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {

            return false;
        }
        if (currentTab == 1)
        {
            document.getElementById("data").value = data;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() 
    {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }

        buttonsList = [];
        var dia, data;
        function horario(i)
        {   
            data = document.getElementById("data").value;
            verificarcao = verificarData(data);
            if(verificarcao[0]){

                buttonsList = [];
                var url = document.URL;
                url = url.replace('/agendar', '/horarios/')
                var xhttp = new XMLHttpRequest();
                if(!i){
                    var urlN = url+document.getElementById("data").value;
                        dia = urlN;
                }
                else  {
                    verificarContinuar()
                    urlN = dia;
                }
                
                xhttp.open("GET", urlN , false);
                xhttp.send();
                document.getElementById("demo").innerHTML = xhttp.responseText;
                document.getElementById("nextBtn").removeAttribute("hidden");
            }
            else{
                document.getElementById("demo").innerHTML =verificarcao[1];
                document.getElementById("nextBtn").removeAttribute("hidden");
            }
        }

        function verificarData(data)
        {
            if(data == '')
            {
                return [0, "Por favor, selecione uma data"];
            }
            console.log(data);
            data = new Date(data);

            atual = {ano : parseInt({{$dateNow->format('o')}}) , mes: parseInt({{$dateNow->format('m')}}), dia : parseInt({{$dateNow->format('d')}})  }
            selecionado = {ano : parseInt(data.getFullYear()) , mes: parseInt(data.getMonth() + 1) , dia : parseInt(data.getDate())};

            if( atual.ano <=  selecionado.ano){
                if((atual.mes  <= selecionado.mes ) || (atual.ano <  selecionado.ano)){
                    if((atual.dia <=  selecionado.dia) || (atual.mes  < selecionado.mes ) || (atual.ano <  selecionado.ano)){
                        return [1];
                    }
                }
            }
            return [0, "Por favor, selecione um dia a partir de amanhã!"];
        }



        function button(id)
        {
            if(document.getElementById(id).className == "btn btn-primary mt-2 ms-1 me-1")//Verifico se o botão pressionado já foi selecionado
            {
                flag = false;//Flag para sinalizar uma "quebra" na escolha dos horarios
                //Essa quebra acontece quando o usuário tenta criar um agendamento que coincide com outro já existente
                buttonsList.push(id); //Concatena na lista o ID do botão pressionado
                if(buttonsList.length > 0)//Verifica se esse não é o primeiro botão selecionado
                {
                    if(Math.min.apply(Math, buttonsList) == id) //Verifca se o botão selecionado tem o menor valor da lista
                    {
                        for (var i = (Math.max.apply(Math, buttonsList)); i > id; i--) //Roda a lista do maior valor até o atual
                        {
                            if(document.getElementById(i).className  == "btn btn-secondary mt-2 ms-1 me-1"){ //Verifica se um botão entre esse 2 horário já não é de outro agendamento
                                flag = true; //Seta a flag de sinalização 
                                break; //QUebra o loop
                            }
                            if(buttonsList.indexOf(i) == -1) //Verifica se o botão já não está na lista
                            {
                                document.getElementById(i).className = "btn btn-info mt-2 ms-1 me-1"; //Muda a classe do botão, mudando assim sua cor
                                buttonsList.push(i); //Concatena o id desse botão na lista
                                document.getElementById(i).disabled = true; //Desabilita esse botão para que ele não possa mais ser clicado
                            }
                        }
                    }
                    else if(Math.max.apply(Math, buttonsList) == id) //Verifca se o botão selecionado tem o maior valor da lista
                    {
                        for (var i = (Math.min.apply(Math, buttonsList)); i < id; i++) //Acontece a mesma coisa que em cima, só que com a ordem invertida
                        {
                            if(document.getElementById(i).className  == "btn btn-secondary mt-2 ms-1 me-1"){
                                flag = true;
                                break;
                            }
                            if(buttonsList.indexOf(i) == -1)
                            {
                                document.getElementById(i).className = "btn btn-info mt-2 ms-1 me-1";
                                buttonsList.push(i);
                                document.getElementById(i).disabled = true;
                            }
                        }
                    }
                }
                if(flag == false)//Caso a flag de sinalização não tenha sido setada
                {
                    document.getElementById(id).className = "btn btn-info mt-2 ms-1 me-1"; //Muda a cor do botão seleciondo
                    document.getElementById(id).disabled = true; //Desabilita esse botão
                    
                }
                else{ //Caso a flag tenha sido setada
                    buttonsList.splice(buttonsList.indexOf(id), 1); //Remove o botão atual da lista
                }             
            }
            verificarContinuar();

            document.getElementById("horarios").value = buttonsList;
            
        }

        function verificarContinuar()
        {
            if(currentTab == 1)
            {
                if(buttonsList.length >1){
                    botaoEnviar = document.getElementById("nextBtn");
                    botaoEnviar.className = "btn btn-primary";
                    botaoEnviar.removeAttribute("disabled");
                }
                else{
                    botaoEnviar = document.getElementById("nextBtn");
                    botaoEnviar.className = "btn btn-secondary";
                    botaoEnviar.disabled = true;
                }
            }
           
        } 
    </script>
@endsection