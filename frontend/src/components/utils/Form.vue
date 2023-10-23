<script>
import {Form, Field, ErrorMessage} from "vee-validate";
import Button from "@/components/utils/Button.vue";

export default {
  components: {
    Button,
    VeeForm: Form,
    VeeField: Field,
    VeeErrorMessage: ErrorMessage
  },
  name: "Form",
  props:{
    form: {
      type: Object,
      default: {},
    },
    submitting: false
  },
  data(){
    return{
      hasError: true
    }
  }
}
</script>

<template>
  <VeeForm @submit="this.$emit('formSubmit')" :validation-schema="{
    name: (value)=>{
      if(value && value.trim()) return true;
      return 'this field is required'
    },
    description: (value)=>{
      if(value && value.trim()) return true;
      return 'this field is required';
    },
  }">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <VeeField
          name="name"
          v-model="form.name"
          type="text"
          class="form-control"
          id="name"
          required
      />
      <VeeErrorMessage name="name" />
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <VeeField
          name="description"
          v-model="form.description"
          class="form-control "
          :class="{
            'is-invalid': hasError
          }"
          id="description"
          rows="3"
          required
          type="text"
      />
      <VeeErrorMessage class="invalid-feedback" name="description" />
    </div>

    <button  class="btn btn-primary mx-2 my-2"  type="submit" :disabled="submitting">
      <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">{{ submitting? 'Loading...' : 'Submit' }}</span>
    </button>

  </VeeForm>
</template>

<style scoped>

</style>