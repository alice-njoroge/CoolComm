<script>
import axios from "axios";

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
  },
  methods:{
    async saveCategory(){
      this.submitting = true;

        await axios.post('http://api.backend.orb.local/products/categories', this.form);

      this.submitting = false;
      this.$router.push({name: 'categories'})
    },
    onCancel(){
      this.$router.push({name: 'categories'})
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
    <button  class="btn btn-primary" @click="saveCategory" type="button" :disabled="submitting">
      <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">{{ submitting? 'Loading...' : 'Save changes' }}</span>
    </button>

    <button class="btn btn-secondary mx-2" @click="onCancel" > Cancel </button>
    </div>

</template>

<style scoped>

</style>