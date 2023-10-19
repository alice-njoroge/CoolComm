<script>
import axios from "axios";
import Form from "@/components/utils/Form.vue";
import Button from "@/components/utils/Button.vue";

export default {
  name: "CategoryCreate",
  components: {Button, Form},
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
  }
}
</script>

<template>
  <div>
    <h3 class="text-center mb-2"> Create a New Category</h3>
    <Form :form="this.form"></Form>
    <Button name="Save Category" @click="saveCategory" :submitting="submitting"></Button>
    <Button  @click="$router.back()" name="Cancel" class="btn btn-secondary"/>

    </div>

</template>

<style scoped>

</style>