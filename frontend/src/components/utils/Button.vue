<script>
export default {
  name: "Button",
  props: {
    submitting:{
      default: false
    },
    name: {
      type: String,
      default: ''
    },

  }
}
</script>

<template>
  <button  class="btn btn-primary mx-2"  type="button" :disabled="submitting">
    <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
    <span role="status">{{ submitting? 'Loading...' : this.name }}</span>
  </button>
</template>

<style scoped>

</style>