<template>
    <div>
      <div v-for="option in options" :key="option.value">
        <input
          type="radio"
          :name="option.name"
          :value="option.value"
          v-model="selectedGender"
          @click="checkboxchecked"
        />
        <label :for="option.value">{{ option.label }}</label>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        options: [
          { name: 'gender', value: 'male', label: 'Male' },
          { name: 'gender', value: 'female', label: 'Female' }
        ],
        selectedGender: null,
        previousGender: null,
      };
    },
    methods: {
      checkboxchecked(event) {
        console.log(event);
        if (!confirm('Do you really want to select this option?')) {
          event.preventDefault();
          this.selectedGender = this.previousGender;
        } 
      },
    },
  };
  </script>
  