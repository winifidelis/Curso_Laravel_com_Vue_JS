@extends('layouts.app')

@section('content')
<!-- https://www.w3schools.com/colors/colors_picker.asp !-->
<!-- https://ionicons.com/v2/ !-->

<pagina tamanho='12'>





    @if($errors->all())
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Erro</h4>
        @foreach($errors->all() as $erro => $value)
        <li>{{$value}}</li>
        @endforeach
    </div>
    @endif

    <painel titulo='Lista de artigos'>

        <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>

        <tabela-lista v-bind:titulos="['#','Titulo','Descrição','Autor','Data']" v-bind:itens="{{$listaArtigos}}" ordem="asc" ordemcol="0" criar="#criar" detalhe="#detalhe" editar="#editar" deletar="#deletar" token="321321321" modal="sim">
        </tabela-lista>
    </painel>
</pagina>

<modal nome="adicionar" titulo="Gravar dados">
    <formulario id="formAdicionar" css="" action="{{route('artigos.store')}}" method="post" enctype="" token="{{ csrf_token() }}">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}">
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor" value="{{old('autor')}}">
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="datetime-local" class="form-control" id="data" name="data" placeholder="Data" value="{{old('data')}}">
        </div>
        <div class="form-group">
            <label for="conteudo">Conteúdo</label>
            <textarea id="conteudo" name="conteudo" rows="5" class="form-control">{{old('conteudo')}}</textarea>
        </div>
    </formulario>
    <span slot="botoes">
        <button form="formAdicionar" class="btn btn-primary">Adicionar</button>
    </span>

</modal>

<modal nome="editar" titulo="Editar dados">
    <formulario id="formEditar" css="" action="#" method="post" enctype="" token="">
        <input type="hidden" id="id" v-model="$store.state.item.id">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" v-model="$store.state.item.titulo" placeholder="Título">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" v-model="$store.state.item.descricao" placeholder="Descrição">
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" id="autor" v-model="$store.state.item.autor" placeholder="Autor">
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="text" class="form-control" id="data" v-model="$store.state.item.data" placeholder="Data">
        </div>
    </formulario>
    <span slot="botoes">
        <button form="formEditar" class="btn btn-primary">Editar</button>
    </span>
</modal>

<modal nome="detalhe" v-bind:titulo='$store.state.item.titulo'>
    <label>Titulo: @{{$store.state.item.titulo}}</label><br>
    <label>Descrição: @{{$store.state.item.descricao}}</label><br>
    <label>Autos: @{{$store.state.item.autor}}</label><br>
    <label>Conteúdo: @{{$store.state.item.conteudo}}</label><br>
    <label>Data: @{{$store.state.item.data}}</label><br>
</modal>
@endsection