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
        <tabela-lista
        v-bind:titulos="['#','Titulo','Descrição','Autor','Data']"
        v-bind:itens="{{json_encode($listaArtigos)}}"
        ordem="desc" ordemcol="0"
        criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="{{ csrf_token() }}"
        modal="sim">

        </tabela-lista>

        <div aling="center">
            {{$listaArtigos->links()}}
        </div>

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
            <input type="date" class="form-control" id="data" name="data" placeholder="Data" value="{{old('data')}}">
        </div>
        <div class="form-group">
            <label for="addconteudo">Conteúdo</label>
            <ckeditor
                id="addconteudo" name="conteudo"
                value="{{old('conteudo')}}" 
                v-bind:config="{
                    toolbar: [
                    ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript']
                    ],
                    height: 200
                }" 
            />
        </div>
    </formulario>
    <span slot="botoes">
        <button form="formAdicionar" class="btn btn-primary">Adicionar</button>
    </span>

</modal>

<modal nome="editar" titulo="Editar dados">
    <formulario id="formEditar" css="" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
        <input type="hidden" id="id" v-model="$store.state.item.id">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo"  v-model="$store.state.item.titulo" placeholder="Título">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descrição">
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" v-model="$store.state.item.autor" placeholder="Autor">
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" placeholder="Data" v-model="$store.state.item.data">
        </div>
        <div class="form-group">
            <label for="editconteudo">Conteúdo</label>
            <ckeditor
                id="editconteudo" name="conteudo"
                v-model="$store.state.item.conteudo" 
                v-bind:config="{
                    toolbar: [
                    ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript']
                    ],
                    height: 200
                }" 
            />
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