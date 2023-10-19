<script>
import axios from "axios";

export default {
  name: "CategoryEdit",
  props: {
    id:{
      type: Number,
      required: true,
    }
  },

  data() {
    return {
      category: {},
      form:{
        name:"",
        description:""
      },
      submitting: false
    }
  },
  methods:{
    async editCategory(){
      this.submitting = true;
      await axios.put(`http://api.backend.orb.local/products/categories/${this.id}`, this.form);

      this.submitting = false;
      this.$router.push({name: 'categories'})

    }
  },

  async created() {
    const response = await axios.get(`http://api.backend.orb.local/products/categories/${this.id}`);
    this.category = response.data;
  
    //prefill the form with category data
    this.form.name = this.category.name;
    this.form.description = this.category.description;
  }
}
</script>

<template>
  <div>
    <h3 class="text-center mb-2"> Edit Category {{category.id}}</h3>
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
    <button  class="btn btn-primary" @click="editCategory" type="button" :disabled="submitting">
      <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">{{ submitting? 'Loading...' : 'Save changes' }}</span>
    </button>
  </div>
</template>

<style scoped>

</style>