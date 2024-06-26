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
                <tabList>
                  </tabList>
                
        </div>
    </div>
    </div>
</div>
</template>



<script>
import ProductList from './ItemList.vue'
import tabList from './tabList.vue'


export default {
  components: {
    ProductList,
    tabList
  },
};
</script>