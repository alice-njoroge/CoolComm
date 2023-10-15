<script>
import axios from "axios";
import { format } from "date-fns";
export default {
  name: "productsCategories",
  data(){
    return{
      productCategories: []
    }
  },
  methods:{
    async fetchProductCategories(){
      const response = await axios.get('http://api.backend.orb.local/products/categories');
      this.productCategories = response.data;

    },

    dateFormat(dateCreated){
      return format(new Date(dateCreated), "MMMM do, yyyy")
    }
  },
  created() {
    this.fetchProductCategories()
  }
}
</script>

<template>
  <h3 class="text-center mb-2">Product Categories </h3>

  <table class="table">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Date Created</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(category, index) in productCategories" :key="index">
      <th scope="row">{{index + 1}}</th>
      <td>{{ category.name }}</td>
      <td>{{ category.description }}</td>
      <td>{{ dateFormat(category.created_at) }}</td>
    </tr>
    </tbody>
  </table>

</template>

<style scoped>

</style>