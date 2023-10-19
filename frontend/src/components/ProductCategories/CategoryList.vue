<script>
import axios from "axios";
import {format} from "date-fns";
import {Modal} from 'bootstrap'

export default {
  name: "categoryList",
  data() {
    return {
      productCategories: [],
      modal: null,
      submitting:false,
      editing: false,
      deleting : false,
      category:null,
      form: {
        name: '',
        description: '',
        id:null
      }
    }
  },
  methods: {
    async removeCategory(){
      this.submitting = true;
      await axios.delete('http://api.backend.orb.local/products/categories/' + this.category.id);

      this.category = null;

      await this.fetchProductCategories();
      this.closeModal();
      this.deleting = false;
      this.submitting = false;
    },
    remove(category){
      this.deleting = true;
      this.editing = false;
      this.showModal();
      this.category = category;

    },

    async fetchProductCategories() {
      const response = await axios.get('http://api.backend.orb.local/products/categories');
      this.productCategories = response.data;

    },
    add(){
      this.$router.push({name: 'CategoryCreate'})
    },
    edit(category) {
      this.$router.push({name: 'CategoryEdit', params:{id: category.id} })
    },


    dateFormat(dateCreated) {
      return format(new Date(dateCreated), "MMMM do, yyyy")
    },
    showModal() {
      if (this.modal) {
        this.modal.show()
      }
    },
    closeModal() {
      this.modal.hide()
    },
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
    <button type="button" @click="add" class="btn btn-primary">Add</button>
  </div>
  <!-- Modal -->
  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" ref="addCategoryModal"
       id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" v-if="deleting" id="exampleModalLabel"> Remove Product Category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p > Are you sure you want to delete this category ?? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

          <button v-if="deleting" @click="removeCategory" class="btn btn-danger" type="button" :disabled="submitting">
            <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            <span role="status"> {{ submitting ? 'Loading...': 'Delete Category'  }}</span>
          </button>

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
      <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(category, index) in productCategories" :key="index">
      <th scope="row">{{ index + 1 }}</th>
      <td>{{ category.name }}</td>
      <td>{{ category.description }}</td>
      <td>{{ dateFormat(category.created_at) }}</td>
      <td>
        <button type="button" @click="edit(category)" class="btn btn-secondary mx-1">Edit</button>
        <button type="button" @click="remove(category)" class="btn btn-danger">Remove</button>
      </td>
    </tr>
    </tbody>
  </table>

</template>

<style scoped>

</style>