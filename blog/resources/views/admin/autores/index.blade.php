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

    <painel titulo='Lista de autores'>

        <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
        <tabela-lista
        v-bind:titulos="['#','Nome','Email']"
        v-bind:itens="{{json_encode($listaModelo)}}"
        ordem="asc" ordemcol="0"
        criar="#criar" detalhe="/admin/autores/" editar="/admin/autores/"
        modal="sim">

        </tabela-lista>

        <div aling="center">
            {{$listaModelo->links()}}
        </div>

    </painel>
</pagina>

<modal nome="adicionar" titulo="Gravar dados">
    <formulario id="formAdicionar" css="" action="{{route('autores.store')}}" method="post" enctype="" token="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">Nomes</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <select class="form-control" id="autor" name="autor">
                <option {{(old('autor') && old('autor') == 'N' ? 'selected' : '')}} value="N">Não</option>
                <option {{(old('autor') && old('autor') == 'S' ? 'selected' : '')}} {{(!old('autor') ? 'selected' : '')}} value="S">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Senha" value="{{old('password')}}">
        </div>

    </formulario>
    <span slot="botoes">
        <button form="formAdicionar" class="btn btn-primary">Adicionar</button>
    </span>

</modal>

<modal nome="editar" titulo="Editar dados">
    <formulario id="formEditar" css="" v-bind:action="'/admin/autores/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
        <input type="hidden" id="id" v-model="$store.state.item.id">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name"  v-model="$store.state.item.name" placeholder="Nome">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" v-model="$store.state.item.email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="autor">Autor</label>
            <select class="form-control" id="autor" name="autor" v-model="$store.state.item.autor">
                <option value="N">Não</option>
                <option value="S">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" v-model="$store.state.item.password" placeholder="Senha">
        </div>
    </formulario>
    <span slot="botoes">
        <button form="formEditar" class="btn btn-primary">Editar</button>
    </span>
</modal>

<modal nome="detalhe" v-bind:titulo='$store.state.item.name'>
    <label>Email: @{{$store.state.item.email}}</label><br>
</modal>
@endsection