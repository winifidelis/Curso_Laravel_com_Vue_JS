@extends('layouts.app')

@section('content')
<!-- https://www.w3schools.com/colors/colors_picker.asp !-->
<!-- https://ionicons.com/v2/ !-->

<pagina tamanho='12'>
    <painel titulo='Lista de artigos'>
        <tabela-lista v-bind:titulos="['#','Titulo','Descrição','Autor','Data']"
        v-bind:itens="[[1,'php','laravel','alguem ','24/01/1986'],[2,'java','jsf','sun ','24/01/1986']]"
        criar="#criar"
        detalhe="#detalhe"
        editar="#editar"
        deletar="#deletar"
        token="321321321"
        >
    </tabela-lista>
    </painel>
</pagina>
@endsection