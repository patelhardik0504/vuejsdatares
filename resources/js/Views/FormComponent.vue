<template>
    <div>
      <form @submit.prevent="submitForm">
        <textarea v-model="formData"></textarea>
        <button type="submit">Submit</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        formData: '',
      };
    },
    methods: {
      async submitForm() {
        try {
          await axios.post('/api/forms', { data: this.formData });
          alert('Form submitted successfully');
        } catch (error) {
          console.error(error);
          alert('Error submitting form');
        }
      },
    },
  };
  </script>
  