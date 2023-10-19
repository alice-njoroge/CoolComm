<script>
import axios from "axios";
import Form from "@/components/utils/Form.vue";

export default {
  name: "CategoryCreate",
  components: {Form},
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
     <Form :form="this.form"></Form>
    <button  class="btn btn-primary" @click="saveCategory" type="button" :disabled="submitting">
      <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">{{ submitting? 'Loading...' : 'Save changes' }}</span>
    </button>

    <button class="btn btn-secondary mx-2" @click="onCancel" > Cancel </button>
    </div>

</template>

<style scoped>

</style>