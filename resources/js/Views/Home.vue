<template>
  <div class="max-w-screen-lg mx-auto text-gray-900">
    <div class="flex justify-center">
        <div class="flex-1">
            <div class="border w-auto">
                <div  class="border p-4 font-semibold ">Dashboard</div>

                <div class="p-4 bg-white">
                    

                    You are Home !sds
                    <ProductList />

                </div>

                
            </div>
        </div>
    </div>
</div>
</template>



<script>
import ProductList from './ItemList.vue'

export default {
  components: {
    ProductList
  }
};
</script>