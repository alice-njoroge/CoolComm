<script>
import axios from "axios";
import Form from "@/components/utils/Form.vue";
import Button from "@/components/utils/Button.vue";
import NotFound from "@/components/utils/NotFound.vue";

export default {
  name: "CategoryEdit",
  components: {Button, Form},
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
      submitting: false,
      categoryFound: false
    }
  },
  methods:{
    async editCategory(){
      this.submitting = true;
      await axios.put(`http://api.backend.orb.local/products/categories/${this.id}`, this.form);

      this.submitting = false;
      this.$router.push({name: 'categories'})
    },
  },

  async created() {
   try {
     const response = await axios.get(`http://api.backend.orb.local/products/categories/${this.id}`);
     this.category = response.data;
     this.categoryFound = true
   }catch (e) {
     console.log("error", e)
   }

    //prefill the form with category data
    this.form.name = this.category.name;
    this.form.description = this.category.description;
  }
}
</script>

<template>
  <div v-if="categoryFound">
    <h3 class="text-center mb-2"> Edit Category {{category.id}}</h3>
    <Form :form="this.form"></Form>
    <Button name="Save Changes" @click="editCategory" :submitting="submitting"></Button>
    <Button  @click="$router.back()" name="Cancel" class="btn btn-secondary"/>
    <!-- TODO: how can I delete from here?? would love to open a confirmation modal first -->
    <Button class="btn btn-danger" name="Remove Category"/>
  </div>
  <div v-else>
    <p> ooopsie, item not found! you can try going back to
      <router-link to="/categories">categories</router-link>
      page and select an item again
    </p>
  </div>
</template>

<style scoped>

</style>