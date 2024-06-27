<template>
    <div>
      <h1>Select Items</h1>
      <div v-for="(item, index) in items" :key="index">
        <input type="checkbox" :value="item" v-model="selectedItems">
        <label>{{ item }}</label>
      </div>
      <p>Selected Items: {{ selectedItems }}</p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        items: ['Item 1', 'Item 2', 'Item 3', 'Item 4'],
        // Initialize selectedItems with the array of selected values
        selectedItems: ['Item 2', 'Item 4','Item 3']
      };
    }
  };
  </script>
  
  <style scoped>
  /* Add your styles here */
  </style>
  