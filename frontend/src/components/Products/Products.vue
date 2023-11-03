<script>
import axios from "axios";

export default {
  name: "Products",
  data() {
    return {
      products: []
    }
  },

  methods: {
    async fetchProducts() {
      const response = await axios.get('http://api.backend.orb.local/products');
      this.products = response.data;
      console.log(this.products)
    },

    getImage(imagePath) {
      const path = new URL('@/assets/images/', import.meta.url).href
      return `${path}/${imagePath}`
    }
  },
  created() {
    this.fetchProducts()
  }
}
</script>

<template>
  <div v-for="product in products" class="col-md-3">
    <div class="card">
      <img :src="getImage(product.imagePath)" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{ product.name }}</h5>
        <p class="card-text">{{ product.description }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>