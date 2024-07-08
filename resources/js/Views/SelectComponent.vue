<template>
  <div>
    <Form @submit="submitForm" ref="form">
      <Field name="options" v-slot="{ field, errors, validate, resetField }" :rules="validateOptions">
        <div>
          <select  ref="select" multiple placeholder="Please select the opt">
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
            <option value="option5">Option 5</option>
            <option value="option6">Option 6</option>
            <option value="option7">Option 7</option>
            <option value="option8">Option 8</option>
            <option value="option9">Option 9</option>
          </select>
          <span v-if="errors.length">{{ errors[0] }}</span>
        </div>
      </Field>
      <button type="submit">Submit</button>
    </Form>
  </div>
</template>

<script>
import { Field, Form } from 'vee-validate';
import axios from 'axios';
import $ from 'jquery';
import 'select2';

export default {
  components: {
    Field,
    Form,
  },
  data() {
    return {
      selectedValue: [],
      select2Instance: null,
    };
  },
  mounted() {
  // Initialize Select2
  this.select2Instance = $(this.$refs.select).select2({
    placeholder: 'Please select an option', // Set your desired placeholder text here
  });

  // Watch for changes and update Vue model
  this.select2Instance.on('change', () => {
    this.selectedValue = this.select2Instance.val();
    // Manually trigger validation
    this.$refs.form.validateField('options');
  });
},

  beforeDestroy() {
    // Destroy Select2 instance to prevent memory leaks
    if (this.select2Instance) {
      this.select2Instance.off('change').select2('destroy');
    }
  },
  methods: {
    validateOptions(value) {
      console.log(this.selectedValue.length);
      if (!this.selectedValue || this.selectedValue.length === 0) {
        return 'At least one option must be selected';
      }
      return true;
    },
    submitForm() {
      this.$refs.form.validate().then((success) => {
        if (success) {
          // Handle form submission
          const formData = {
            options: this.selectedValue,
          };

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

<style scoped>
/* Add any custom styles here if needed */
</style>
