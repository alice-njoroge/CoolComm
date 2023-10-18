<script>

import {defineComponent} from "vue";
import ProductsCategories from "@/components/ProductCategories/ProductsCategories.vue";
import HeaderSection from "@/components/utils/HeaderSection.vue";

export default defineComponent({
  components: {HeaderSection, ProductsCategories}
})
</script>
<template>
  <main>
    <div class="container">
      <header-section></header-section>
      <div class="row">
        <router-view></router-view>
      </div>
    </div>
  </main>

</template>