<template>
  <div
    class="modal fade"
    v-bind:id="nome"
    tabindex="-1"
    role="dialog"
    v-bind:aria-labelledby="nome"
    aria-hidden="true"
  >
    <!-- <div class="modal-dialog modal-lg" role="document"> !-->
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{titulo}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <slot></slot>
        </div>
        <div class="modal-footer">
          <slot name="botoes"></slot>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
        <!--
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        !-->
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props:['nome','titulo']
};
</script>