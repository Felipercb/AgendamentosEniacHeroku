 @extends('layout')

@section('cabecalho')
Login


@endsection

@include('erros', ['errors' => $errors])

@section('conteudo')


<div class="row p-5" >
<button type="button" class="btn btn-proximo-voltar">

    <a href="{{ url('auth/google') }}" style="margin-top: 0px !important;text-decoration:none;color: #ffffff;padding: 5px;border-radius:7px;" class="ml-2 btn-google">
        <strong>Login com Google </strong> <i class="fab fa-google"></i>
      </a>

</button>
</div>

@endsection