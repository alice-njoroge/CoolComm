<script>
export default {
  name: "Form",
  props:{
    form: {
      type: Object,
      default: {},
    }
  }
}
</script>

<template>
  <form>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input
          v-model="form.name"
          type="text"
          class="form-control"
          id="name"
          required
      >
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea
          v-model="form.description"
          class="form-control"
          id="description"
          rows="3"
          required
          type="text"
      >

          </textarea>
    </div>
  </form>
</template>

<style scoped>

</style>