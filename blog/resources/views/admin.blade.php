@extends('layouts.app')

@section('content')



<pagina tamanho='12'>

    <painel titulo='Dashboard'>

        <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <caixa qtd='{{$totalArtigos}}' titulo='Artigos' url="{{route('artigos.index')}}" cor="#ff944d" icone="ion ion-xbox"></caixa>
        </div>
        <div class="col-md-4">
            <caixa qtd='{{$totalUsuarios}}' titulo='Usuários' url="{{route('usuarios.index')}}" cor="#668cff" icone="ion ion-beer"></caixa>
        </div>
        <div class="col-md-4">
            <caixa qtd='{{$totalAutores}}' titulo='Autores' url="{{route('autores.index')}}" cor="#ff3333" icone="ion ion-android-plane"></caixa>
        </div>
    </div>
</div>

    </painel>
</pagina>
<!-- https://www.w3schools.com/colors/colors_picker.asp !-->
<!-- https://ionicons.com/v2/ !-->


<br><br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <painel titulo='Titulo do timão' cor='success'>
                <div class="row">
                    <div class="col-md-6">
                        <painel titulo='Paulista' cor='pink'>
                            Tem um monte!
                    </div>
                    <div class="col-md-6">
                        <painel titulo='Mundiais'>
                            Tem 2
                    </div>
                </div>
            </painel>
        </div>
        <div class="col-md-6">
            <painel titulo='VIIIILAAAA' cor='danger'>
                O maior do centro oeste!
            </painel>
        </div>
    </div>
</div>
<pagina tamanho='10'>
    <painel titulo='Teste'>
        <div class="row">
            <div class="col-md-4">
                <caixa qtd='50' titulo='Artigos' url='#teste' cor="#ff944d" icone="ion ion-xbox"></caixa>
            </div>
            <div class="col-md-4">
                <caixa qtd='400' titulo='Verbos' url='#teste' cor="#668cff" icone="ion ion-beer"></caixa>
            </div>
            <div class="col-md-4">
                <caixa qtd='262' titulo='Preposições' url='#teste' cor="#ff3333" icone="ion ion-android-plane"></caixa>
            </div>
        </div>
    </painel>
</pagina>
@endsection