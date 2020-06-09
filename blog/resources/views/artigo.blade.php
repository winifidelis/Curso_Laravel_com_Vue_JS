@extends('layouts.app')

@section('content')



<pagina tamanho='12'>

    <painel>

        <h2 class="d-flex justify-content-center">{{$artigo->titulo}}</h2>
        <p class="d-flex justify-content-center">{{$artigo->descricao}}</p>
        <p>
            {!!$artigo->conteudo!!}
        </p>
        <p class="d-flex justify-content-center">
            <small>Por: {{$artigo->user->name}} - {{date('d/m/Y',strtotime($artigo->data))}}
        </p>

    </painel>


</pagina>


@endsection