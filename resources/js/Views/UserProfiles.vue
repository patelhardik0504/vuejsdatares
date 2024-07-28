<template>
    <div>
      <!-- Button to open the Add Profile modal -->
      <button @click="openAddModal">Add Profile</button>
  
      <!-- Modal for Adding/Editing Profile -->
      <div v-if="showModal" class="modal">
        <div class="modal-content">
          <span class="close" @click="closeModal">&times;</span>
          <h2>{{ isEditing ? 'Edit Profile' : 'Add Profile' }}</h2>
          <form @submit.prevent="isEditing ? updateProfile() : addProfile()">
            <div v-for="(profile, index) in form.profiles" :key="index">
              <input v-model="profile.name" placeholder="Name" required />
              <input v-model="profile.number" placeholder="Number" required />
              <input v-model="profile.email" placeholder="Email" type="email" required />
              <input type="file" @change="handleFileUpload($event, index)" />
            </div>
            <button type="button" @click="addProfileField">Add Another Profile</button>
            <button type="submit">{{ isEditing ? 'Update' : 'Add' }}</button>
          </form>
        </div>
      </div>
  
      <!-- List of Profiles -->
      <div v-for="(userProfile, userProfileIndex) in profiles" :key="userProfileIndex">
        <div v-for="(profile, profileIndex) in userProfile.profiles" :key="profileIndex">
          <p>
            {{ profile.name }} - {{ profile.number }} - {{ profile.email }}
            <img v-if="profile.profile_image" :src="'/storage/' + profile.profile_image" alt="Profile Image" />
          </p>
        </div>
        <button @click="openEditModal(userProfile, userProfileIndex)">Edit</button>
        <button @click="deleteProfile(userProfile.id)">Delete</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        profiles: [],
        showModal: false,
        isEditing: false,
        currentProfileId: null,
        form: {
          profiles: [
            {
              name: '',
              number: '',
              email: '',
              profile_image: null,
            },
          ],
        },
      };
    },
    methods: {
      async fetchProfiles() {
        const response = await axios.get('/api/user-profiles');
        this.profiles = response.data;
      },
      openAddModal() {
        this.resetForm();
        this.showModal = true;
        this.isEditing = false;
      },
      openEditModal(userProfile, userProfileIndex) {
        this.form.profiles = userProfile.profiles;
        this.currentProfileId = this.profiles[userProfileIndex].id;
        this.showModal = true;
        this.isEditing = true;
      },
      closeModal() {
        this.showModal = false;
      },
      async addProfile() {
        const formData = new FormData();
        this.form.profiles.forEach((profile, index) => {
          formData.append(`profiles[${index}][name]`, profile.name);
          formData.append(`profiles[${index}][number]`, profile.number);
          formData.append(`profiles[${index}][email]`, profile.email);
          if (profile.profile_image) {
            formData.append(`profiles[${index}][profile_image]`, profile.profile_image);
          }
        });
  
        await axios.post('/api/user-profiles', formData);
        this.fetchProfiles();
        this.closeModal();
      },
      async updateProfile() {
        const formData = new FormData();
        this.form.profiles.forEach((profile, index) => {
          formData.append(`profiles[${index}][name]`, profile.name);
          formData.append(`profiles[${index}][number]`, profile.number);
          formData.append(`profiles[${index}][email]`, profile.email);
          if (profile.profile_image) {
            formData.append(`profiles[${index}][profile_image]`, profile.profile_image);
          }
        });
  
        await axios.put(`/api/user-profiles/${this.currentProfileId}`, formData);
        this.fetchProfiles();
        this.closeModal();
      },
      async deleteProfile(id) {
        await axios.delete(`/api/user-profiles/${id}`);
        this.fetchProfiles();
      },
      handleFileUpload(event, index) {
        this.form.profiles[index].profile_image = event.target.files[0];
      },
      addProfileField() {
        this.form.profiles.push({
          name: '',
          number: '',
          email: '',
          profile_image: null,
        });
      },
      resetForm() {
        this.form = {
          profiles: [
            {
              name: '',
              number: '',
              email: '',
              profile_image: null,
            },
          ],
        };
      },
    },
    mounted() {
      this.fetchProfiles();
    },
  };
  </script>
  
  <style scoped>
  .modal {
    display: block;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
  }
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  </style>
  