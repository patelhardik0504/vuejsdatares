<template>
  <div>
    <Form @submit="submitForm" ref="form" :validation-schema="schema">
      <Field name="options" v-slot="{ field, errors }">
        <div>
          <select v-bind="field" ref="select" multiple>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
            <option value="option5">Option 5</option>
            <option value="option6">Option 6</option>
            <option value="option7">Option 7</option>
            <option value="option8">Option 8</option>
            <option value="option10">Option 899</option>
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
import * as yup from 'yup';
import axios from 'axios';

export default {
  components: {
    Field,
    Form,
  },
  data() {
    return {
      selectedValue: [],
      schema: yup.object({
        options: yup.array().min(1, 'At least one option must be selected').required('Options are required'),
      }),
    };
  },
  mounted() {
    // Initialize Select2
    $(this.$refs.select).select2();

    // Watch for changes and update Vue model
    $(this.$refs.select).on('change', () => {
      this.selectedValue = $(this.$refs.select).val();
      this.$refs.form.setFieldValue('options', this.selectedValue);
    });
  },
  beforeDestroy() {
    // Destroy Select2 instance to prevent memory leaks
    $(this.$refs.select).select2('destroy');
  },
  methods: {
    submitForm() {
      this.$refs.form.validate().then((success) => {
        if (success) {
          // Handle form submission
          const formData = {
            options: this.selectedValue,
          };

          console.log(this.selectedValue);

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
