<script>
export default {
  name: "CategoryEdit",

  data() {
    return {
      categoryId: null,
      form:{
        name:"",
        description:""
      }
    }
  },

  created() {
    this.categoryId = this.$route.params.id
  }
}
</script>

<template>
  <div>
    <h3 class="text-center mb-2"> Edit Category {{categoryId}}</h3>
    <form >
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input v-model="form.name" type="text" class="form-control" id="name">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea v-model="form.description" class="form-control" id="description" rows="3"></textarea>
      </div>
    </form>
  </div>
</template>

<style scoped>

</style>