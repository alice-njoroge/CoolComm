<script>
import axios from "axios";
import Form from "@/components/utils/Form.vue";

export default {
  name: "CategoryEdit",
  components: {Form},
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
    <Form :form="this.form"></Form>
    <button  class="btn btn-primary" @click="editCategory" type="button" :disabled="submitting">
      <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">{{ submitting? 'Loading...' : 'Save changes' }}</span>
    </button>
  </div>
</template>

<style scoped>

</style>