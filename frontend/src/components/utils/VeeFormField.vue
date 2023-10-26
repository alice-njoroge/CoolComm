<script>
export default {
  name: "VeeFormField",
  props: {
    label: {
      type: String,
      default: ''
    },

    name: {
      type: String,
      default: ''
    }
  }
}
</script>

<template>
  <div class="mb-3">
    <label :for="name" class="form-label">{{ label }}</label>
    <VeeField
        :name="name"
        :modelValue="modelValue"
        @input="$emit('modelValue', $event)"
        class="form-control "
        :class="{
            'is-invalid': hasError
          }"
        :id="name"
        v-bind="$attrs"
        :label="label"
    />
    <VeeErrorMessage :name="name"/>
  </div>
</template>

<style scoped>

</style>