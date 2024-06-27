<template>
    <div>
      <select ref="select" v-model="selectedValue" multiple>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
      </select>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        selectedValue: ''
      };
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
  
  <style scoped>
  /* Add any custom styles here if needed */
  </style>
  