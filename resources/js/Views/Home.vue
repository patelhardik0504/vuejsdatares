<template>
  <div class="max-w-screen-lg mx-auto text-gray-900">
    <div class="flex justify-center">
        <div class="flex-1">
            <div class="border w-auto">
                <div  class="border p-4 font-semibold ">Dashboard</div>

                <div class="p-4 bg-white">
                    

                    You are Home !sds
                    <!-- <Posts /> -->

                </div>
                <!-- <tabList>
                  </tabList> -->
                 <SelectMultiple>
                  
                 </SelectMultiple>
                  <!-- <select name="" id="" ref="select" v-model="selectedValue" multiple>
                    <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
                  </select> -->

        </div>
    </div>
    </div>
</div>
</template>



<script>
import ProductList from './ItemList.vue'
import tabList from './tabList.vue'
import Checkbox from './Checkbox.vue'
import SelectComponent from './SelectComponent.vue';
import Posts  from './Posts.vue';
import FileUpload from './FileErrorHandel.vue';
import SelectMultiple from './SelectComponent.vue';




export default {
  components: {
    ProductList,
    tabList,SelectComponent,
    Posts ,
    FileUpload,
    SelectMultiple
    
  },
  mounted() {
      // Initialize Select2
      $(this.$refs.select).select2();
  
      // Watch for changes and update Vue model
      $(this.$refs.select).on('change', () => {
        this.selectedValue = $(this.$refs.select).val();
      });
    },
    beforeDestroy() {
      // Destroy Select2 instance to prevent memory leaks
      $(this.$refs.select).select2('destroy');
    }
};
</script>