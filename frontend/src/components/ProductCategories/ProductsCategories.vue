<script>
import axios from "axios";
import {format} from "date-fns";
import {Modal} from 'bootstrap'

export default {
  name: "productsCategories",
  data() {
    return {
      productCategories: [],
      modal: null,
    }
  },
  methods: {
    async fetchProductCategories() {
      const response = await axios.get('http://api.backend.orb.local/products/categories');
      this.productCategories = response.data;

    },

    dateFormat(dateCreated) {
      return format(new Date(dateCreated), "MMMM do, yyyy")
    },
    showModal(){
      if(this.modal){
        this.modal.show()
      }
    },
    closeModal(){
      this.modal.close()
    }
  },
  created() {
    this.fetchProductCategories()
  },
  mounted() {
    this.modal = new Modal(this.$refs.addCategoryModal)
  }
}
</script>

<template>
  <h3 class="text-center mb-2">Product Categories </h3>
  <div class="d-flex justify-content-end">
    <button type="button" @click="showModal" class="btn btn-primary">Add</button>
  </div>
  <!-- Modal -->
  <div class="modal fade" ref="addCategoryModal" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

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
      <th scope="row">{{ index + 1 }}</th>
      <td>{{ category.name }}</td>
      <td>{{ category.description }}</td>
      <td>{{ dateFormat(category.created_at) }}</td>
    </tr>
    </tbody>
  </table>

</template>

<style scoped>

</style>