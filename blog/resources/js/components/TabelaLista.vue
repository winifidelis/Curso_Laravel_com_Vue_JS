<template>
  <div>
    <div class="form-inline">
      <div class="col-md-6">
        <a v-if="criar && !modal" v-bind:href="criar">Criar</a>
        <modal-link v-if="criar && modal" tipo='link' nome='adicionar' titulo='Criar' css=''></modal-link>
      </div>
      <div class="col-md-6">
        <div class="form-group float-sm-right">
          <input type="search" class="form-control" placeholder="Buscar" v-model="buscar" />
        </div>
      </div>
    </div>
    <br />
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th
            :key="index[0]"
            style="cursor:pointer"
            v-on:click="ordenaColuna(index)"
            v-for="(titulo, index) in titulos"
          >{{titulo}}</th>

          <th v-if="detalhe || editar || deletar">Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr :key="index[0]" v-for="(item, index) in lista">
          <td :key="i.id" v-for="i in item">{{i}}</td>

          <!-- BOTÕES DE AÇÕES!-->
          <td v-if="detalhe || editar || deletar">
            <!-- o method do formulário está post, mas ele é modificado abaixo !-->
            <form v-bind:id="index" v-if="deletar && token" v-bind:action="deletar + item.id" method="post">
              <!-- ELE É MODIFICADO AQUI !--> 
              <input type="hidden" name="_method" value="DELETE" />
              <input type="hidden" name="_token" v-bind:value="token" />

              <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhes |</a>
              <modal-link v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo='link' nome='detalhe' titulo='Detalhe |' css=''></modal-link>

              <a v-if="editar && !modal" v-bind:href="editar">Editar |</a>
              <modal-link v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo='link' nome='editar' titulo='Editar |' css=''></modal-link>

              <a href="#" v-on:click="executaForm(index)">Deletar </a>

            </form>
            <span v-if="!token">
              <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhes |</a>
              <modal-link v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo='link' nome='detalhe' titulo='Detalhe |' css=''></modal-link>

              <a v-if="editar && !modal" v-bind:href="editar">Editar |</a>
              <modal-link v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo='link' nome='editar' titulo='Editar |' css=''></modal-link>
              <a v-if="deletar" v-bind:href="deletar">Deletar</a>
            </span>
            <span v-if="token && !deletar">
              <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhes |</a>
              <modal-link v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo='link' nome='detalhe' titulo='Detalhe |' css=''></modal-link>

              <a v-if="editar && !modal" v-bind:href="editar">Editar</a>
              <modal-link v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo='link' nome='editar' titulo='Editar |' css=''></modal-link>
            </span>
          </td>
          <!-- /BOTÕES DE AÇÕES!-->
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: [
    "titulos",
    "itens",
    "criar",
    "detalhe",
    "editar",
    "deletar",
    "token",
    "ordem",
    "ordemcol",
    "modal"
  ],
  data: function() {
    return {
      buscar: "",
      //as variaveis abaixo é para não modificar a variavel de forma direta que vem
      //do props
      ordemAux: this.ordem || "asc",
      ordemcolAux: this.ordemcol || 0
    };
  },
  methods: {
    executaForm: function(index) {
      console.log('TRY')
      console.log(document.getElementById(index))
      document.getElementById(index).submit();
    },
    ordenaColuna: function(coluna) {
      this.ordemcolAux = coluna;
      if (this.ordemAux.toLowerCase() == "asc") {
        this.ordemAux = "desc";
      } else {
        this.ordemAux = "asc";
      }
    }
  },
  computed: {
    lista: function() {

      let lista = this.itens.data;

      let ordem = this.ordemAux;
      let ordemcol = this.ordemcolAux;
      ordem = ordem.toLowerCase();
      ordemcol = parseInt(ordemcol);

      if (ordem == "asc") {
        //sort() ordenação em javascript
        lista.sort(function(a, b) {
          if (Object.values(a)[ordemcol] > Object.values(b)[ordemcol]) {return 1;}
          if (Object.values(a)[ordemcol] < Object.values(b)[ordemcol]) {return -1;}
          return 0;
        });
      } else {
        //sort() ordenação em javascript
        lista.sort(function(a, b) {
          if (Object.values(a)[ordemcol] < Object.values(b)[ordemcol]) {return 1;}
          if (Object.values(a)[ordemcol] > Object.values(b)[ordemcol]) {return -1;}
          return 0;
        });
      }

      if (this.buscar) {
        return lista.filter(res => {
          res = Object.values(res);
          for (let k = 0; k < res.length; k++) {
            if (
              (res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >=
              0
            ) {
              return true;
            }
          }
          return false;
        });
      } else {
        return lista;
      }
    }
  }
};
</script>