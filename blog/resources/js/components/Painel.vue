<template>
  <div class="card">
    <!-- <div class="card-header bg-primary"> !-->
    <div v-bind:class="defineCor">{{titulo}}</div>

    <div class="card-body">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: ["titulo", "cor"],
  computed: {
    defineCor: function() {
      return "card-header bg-" + (this.cor||"primary") ;
    }
  }
};
</script>