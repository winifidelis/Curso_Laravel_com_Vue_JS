<template>
  <ol class="breadcrumb">
    <li :key="item[0]" v-for="item in lista" class="breadcrumb-item">
      <a v-if="item.url" v-bind:class="defineClass" v-bind:href="item.url">{{item.titulo}}</a>
      <span v-if="!item.url">{{item.titulo}}</span>
    </li>
  </ol>
</template>

<script>
export default {
  props: ["lista"],
  //mounted - é executado quando o meu componente está pronto
  mounted: function() {
    //console.log(this.lista);
  },
  computed: {
    defineClass: function() {
      if (this.url) {
        return "active";
      } else {
        return "";
      }
    }
  }
};
</script>