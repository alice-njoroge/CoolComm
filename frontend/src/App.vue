<script>

import {defineComponent} from "vue";

import HeaderSection from "@/components/utils/HeaderSection.vue";
import CategoryList from "@/components/ProductCategories/CategoryList.vue";

export default defineComponent({
  components: {
    HeaderSection,
    CategoryList
  }
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