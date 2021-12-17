@if ($errors->any())
    <div id="mensagem-erro" class="alert alert-danger">
        <ul style="list-style: none;">
            @foreach ($errors->all() as $error)
                <li><i class="fas fa-exclamation-triangle "></i> {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <script>

        setTimeout(function(){
            erro = document.getElementById('mensagem-erro')
            erro.hidden = true;
        }, 4000);

    </script>
@endif