<template>
    <Form @submit="submitForm" ref="form">
      <Field name="file" v-slot="{ field, errors, handleChange }" :rules="validateFile">
        <div>
          <label for="file">Upload File:</label>
          <input type="file" @change="handleFileChange($event, handleChange)" ref="fileInput" />
          <span v-if="errors.length">{{ errors[0] }}</span>
        </div>
      </Field>
      <button type="submit">Submit</button>
    </Form>
  </template>
  
  
  
  
  
  <script>import { Field, Form } from 'vee-validate';
  import { required } from '@vee-validate/rules';
  
  export default {
    components: {
      Field,
      Form,
    },
    data() {
      return {
        selectedFile: null,
      };
    },
    methods: {
      validateFile(value) {
        // Custom validation logic for file input
        if (!this.selectedFile) {
          return 'File is required';
        }
  
        // Example: Check file type and size
        const allowedTypes = ['image/jpeg', 'image/png'];
        const maxSize = 2 * 1024 * 1024; // 2 MB
  
        if (!allowedTypes.includes(this.selectedFile.type)) {
          return 'Only JPEG and PNG files are allowed';
        }
  
        if (this.selectedFile.size > maxSize) {
          return 'File size should not exceed 2 MB';
        }
  
        return true;
      },
      handleFileChange(event, handleChange) {
        this.selectedFile = event.target.files[0];
        handleChange(event); // Notify VeeValidate about the change
      },
      submitForm() {
        this.$refs.form.validate().then((success) => {
          if (success) {
            // Handle form submission
            const formData = new FormData();
            formData.append('file', this.selectedFile);
  
            axios.post('/form-endpoint', formData)
              .then(response => {
                // Handle success
              })
              .catch(error => {
                // Handle error
              });
          }
        });
      },
    },
  };
  
  </script>