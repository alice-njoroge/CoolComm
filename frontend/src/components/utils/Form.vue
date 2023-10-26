<script>
import Button from "@/components/utils/Button.vue";
import VeeFormField from "@/components/utils/VeeFormField.vue";

export default {
  components: {
    VeeFormField,
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
   <vee-form-field  v-model="form.name" name="name" label="Name" rules="required"  rows="3" type="text"/>
   <vee-form-field  id="description"

                    v-model="form.description"
                    name="description"
                    label="Description"
                    rules="required"
                    rows="3"
                    type="text"
   />


    <button class="btn btn-primary mx-2 my-2" type="submit" :disabled="submitting">
      <span v-if="submitting" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
      <span role="status">{{ submitting ? 'Loading...' : 'Submit' }}</span>
    </button>

  </VeeForm>
</template>

<style scoped>

</style>