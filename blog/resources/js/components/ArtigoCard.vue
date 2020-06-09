<template>
  <div v-bind:class="'col-sm-' + (sm || '6') + ' col-md-' + (md || 4)">
    <div class="card">
      <img
        src="https://coletiva.net/files/e4da3b7fbbce2345d7772b0674a318d5/midia_foto/20170713/118815-maior_artigo_jul17.jpg"
        class="card-img-top"
        alt="..."
      />
      <div class="card-body">
        <small>{{data | formataData}} - {{autor}}</small>
        <h5 class="card-title">{{titulo}}</h5>
        <p class="card-text">{{descricao}}</p>
        <p>
          <a v-bind:href="link" class="btn btn-primary" role="button">Leia mais</a>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["titulo", "descricao", "link", "imagem", "data", "autor", "sm", "md"],
  filters:{
    formataData: function(valor){
      if(!valor) return '';
      valor = valor.toString();
      if(valor.split('-').length == 3){
        //aqui signijfica que estou tratando a data
        valor = valor.split("-");
        return valor[2]+"/"+valor[1]+"/"+valor[0];
      }
      return valor;
    }
  },
};
</script>