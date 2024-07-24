<template>
    <form @submit.prevent="submitForm">
      <div>
        <label>Password</label>
        <div class="input-group">
          <input :type="passwordFieldType" v-model="password" @input="validatePassword" />
          <span @click="togglePasswordVisibility" class="input-group-text">
            <i :class="passwordIconClass"></i>
          </span>
        </div>
        <span v-if="errors.password">{{ errors.password }}</span>
      </div>
      
      <div>
        <label>Confirm Password</label>
        <div class="input-group">
          <input :type="confirmPasswordFieldType" v-model="confirmPassword" @input="validateConfirmPassword" />
          <span @click="toggleConfirmPasswordVisibility" class="input-group-text">
            <i :class="confirmPasswordIconClass"></i>
          </span>
        </div>
        <span v-if="errors.confirmPassword">{{ errors.confirmPassword }}</span>
      </div>
      
      <button type="submit">Submit</button>
    </form>
  </template>
  
  <script>
  export default {
    data() {
      return {
        password: '',
        confirmPassword: '',
        errors: {
          password: '',
          confirmPassword: ''
        },
        passwordVisible: false,
        confirmPasswordVisible: false,
        passwordIconClass: 'fas fa-eye-slash',
        confirmPasswordIconClass: 'fas fa-eye-slash',
      };
    },
    computed: {
      passwordFieldType() {
        return this.passwordVisible ? 'text' : 'password';
      },
      confirmPasswordFieldType() {
        return this.confirmPasswordVisible ? 'text' : 'password';
      },
    },
    methods: {
      togglePasswordVisibility() {
        this.passwordVisible = !this.passwordVisible;
        this.passwordIconClass = this.passwordVisible ? 'fas fa-eye-slash' : 'fas fa-eye';
      },
      toggleConfirmPasswordVisibility() {
        this.confirmPasswordVisible = !this.confirmPasswordVisible;
        this.confirmPasswordIconClass = this.confirmPasswordVisible ? 'fas fa-eye-slash' : 'fas fa-eye';
      },
      validatePassword() {
        if (this.password.length < 6) {
          this.errors.password = 'Password must be at least 6 characters long';
        } else {
          this.errors.password = '';
        }
        this.validateConfirmPassword();
      },
      validateConfirmPassword() {
        if (this.confirmPassword !== this.password) {
          this.errors.confirmPassword = 'Passwords do not match';
        } else {
          this.errors.confirmPassword = '';
        }
      },
      submitForm() {
        this.validatePassword();
        this.validateConfirmPassword();
  
        if (!this.errors.password && !this.errors.confirmPassword) {
          // Handle form submission
          alert('Form submitted!');
        }
      }
    }
  };
  </script>
  
  <style>
  .input-group {
    display: flex;
    align-items: center;
  }
  .input-group input {
    flex: 1;
    padding: 0.5rem;
  }
  .input-group-text {
    cursor: pointer;
    padding: 0.5rem;
    background: #f0f0f0;
  }
  .input-group-text i {
    font-size: 1.2rem;
  }
  </style>
  