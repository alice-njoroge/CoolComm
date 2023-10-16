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
      editing: false,
      form: {
        name: '',
        description: '',
        id:null
      }
    }
  },
  methods: {
    async saveCategory() {
      if(this.editing){
        await axios.put('http://api.backend.orb.local/products/categories/' + this.form.id , this.form)

      } else{
        await axios.post('http://api.backend.orb.local/products/categories', this.form);
      }

      await this.fetchProductCategories();
      this.closeModal();
    },
    async fetchProductCategories() {
      const response = await axios.get('http://api.backend.orb.local/products/categories');
      this.productCategories = response.data;

    },
    editModal(category) {
      this.editing = true;

      this.form.id = category.id;
      this.form.name = category.name;
      this.form.description = category.description;

      this.showModal();
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
    add(){
      this.form.id = null
      this.form.name = ''
      this.form.description = ''
      this.editing = false;
      this.showModal();
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
    <button type="button" @click="add" class="btn btn-primary">Add</button>
  </div>
  <!-- Modal -->
  <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" ref="addCategoryModal"
       id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ editing ? 'Edit': 'Add'  }} Product Category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input v-model="form.name" type="text" class="form-control" id="name">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea v-model="form.description" class="form-control" id="description" rows="3"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" @click="saveCategory" class="btn btn-primary">Save changes</button>
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
        <button type="button" @click="editModal(category)" class="btn btn-secondary mx-1">Edit</button>
        <button type="button" class="btn btn-danger">Remove</button>
      </td>
    </tr>
    </tbody>
  </table>

</template>

<style scoped>

</style>