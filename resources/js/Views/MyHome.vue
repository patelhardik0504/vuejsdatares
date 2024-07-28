<template>
    <form @submit.prevent="saveSelectedOptions">
      <div>
        <!-- Multiple Select Dropdown -->
        <select v-model="selectedOptionsIds" multiple @change="updateSelectedOptions">
          <option v-for="option in options" :key="option.id" :value="option.id">
            {{ option.name }}
          </option>
        </select>
  
        <!-- Display Selected Options with Checkboxes -->
        <div v-if="selectedOptions.length">
          <h3>Selected Options:</h3>
          <div v-for="(option, index) in selectedOptions" :key="option.id">
            <input 
              type="checkbox" 
              :id="`checkbox-${option.id}`" 
              v-model="option.selected" 
            />
            <label :for="`checkbox-${option.id}`">{{ option.name }}</label>
            <button type="button" @click="removeSelectedOption(index)">Remove</button>
          </div>
        </div>
      </div>
      <button type="submit">Submit</button>
    </form>
  </template>
  
  <script>
  import axios from 'axios';

export default {
  data() {
    return {
      options: [],
      selectedOptionsIds: [], // Array to store selected option ids
      selectedOptions: [] // Array to store selected option objects
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        // Fetch options data
        const optionsResponse = await axios.get('/api/data');
        this.options = optionsResponse.data;

        // Fetch user profile data
        const profileResponse = await axios.get('/api/user-profile');
        const profileData = profileResponse.data;

        // Initialize selected options based on profile data
        this.selectedOptionsIds = profileData.selections.map(option => option.id);
        this.selectedOptions = this.options
          .filter(option => this.selectedOptionsIds.includes(option.id))
          .map(option => ({
            ...option,
            selected: profileData.selections.find(o => o.id === option.id)?.selected || false
          }));
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    },
    updateSelectedOptions() {
      this.selectedOptions = this.options
        .filter(option => this.selectedOptionsIds.includes(option.id))
        .map(option => ({
          ...option,
          selected: this.selectedOptions.find(o => o.id === option.id)?.selected || false
        }));
    },
    removeSelectedOption(index) {
      const optionId = this.selectedOptions[index].id;
      this.selectedOptionsIds = this.selectedOptionsIds.filter(id => id !== optionId);
      this.updateSelectedOptions(); // Update selectedOptions after removing
    },
    async saveSelectedOptions() {
      try {
        // Include all selected options with their respective selected statuses
        const selectedOptionsData = this.selectedOptions.map(option => ({
          id: option.id,
          selected: option.selected
        }));

        // Send the selected options data to the server
        await axios.post('/api/save-selections', { selections: selectedOptionsData });

        console.log('Selected options saved successfully');
      } catch (error) {
        console.error('Error saving selected options:', error);
      }
    }
  }
};

  </script>
  
  <style>
  /* Add any styling you need here */
  </style>
  