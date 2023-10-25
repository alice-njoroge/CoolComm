<script>
import {Form, Field, ErrorMessage} from "vee-validate";
import Button from "@/components/utils/Button.vue";

export default {
  components: {
    Button,
  },
  name: "Form",
  props: {
    form: {
      type: Object,
      default: {},
    },
    submitting: false
  },
  data() {
    return {
      hasError: true
    }
  },

  methods: {

  }
}
</script>

<template>
  <VeeForm @submit="this.$emit('formSubmit')">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <VeeField
          name="name"
          v-model="form.name"
          type="text"
          class="form-control"
          id="name"
          rules="required"
      />
      <VeeErrorMessage name="name"/>
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
          type="text"
          rules="required"
      />
      <VeeErrorMessage class="invalid-feedback" name="description"/>
    </div>

    <button class="btn btn-primary mx-2 my-2" type="submit" :disabled="submitting">
      <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">{{ submitting ? 'Loading...' : 'Submit' }}</span>
    </button>

  </VeeForm>
</template>

<style scoped>

</style>