<script>
export default {
  name: "CategoryCreate",
  data(){
    return{
      form: {
        name: "",
        description: ""
      },
      submitting: false
    }
  }
}
</script>

<template>
  <div>
    <h3 class="text-center mb-2"> Create a New Category</h3>
      <form>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" rows="3"></textarea>
        </div>
      </form>
    <button  class="btn btn-primary" @click="saveCategory" type="button" :disabled="submitting">
      <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">{{ submitting? 'Loading...' : 'Save changes' }}</span>
    </button>
    </div>

</template>

<style scoped>

</style>