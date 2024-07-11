<template>
  <div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <button class="nav-link" 
              :class="{ active: currentTab === 'home' }" 
              @click="changeTab('home')"
              type="button" 
              role="tab" 
              aria-controls="v-pills-home" 
              :aria-selected="currentTab === 'home'"
              :disabled="isDisabled('home')">Home</button>
      <button class="nav-link" 
              :class="{ active: currentTab === 'profile' }" 
              @click="changeTab('profile')"
              type="button" 
              role="tab" 
              aria-controls="v-pills-profile" 
              :aria-selected="currentTab === 'profile'"
              :disabled="isDisabled('profile')">Profile</button>
      <button class="nav-link" 
              :class="{ active: currentTab === 'messages' }" 
              @click="changeTab('messages')"
              type="button" 
              role="tab" 
              aria-controls="v-pills-messages" 
              :aria-selected="currentTab === 'messages'"
              :disabled="isDisabled('messages')">Messages</button>
      <button class="nav-link" 
              :class="{ active: currentTab === 'settings' }" 
              @click="changeTab('settings')"
              type="button" 
              role="tab" 
              aria-controls="v-pills-settings" 
              :aria-selected="currentTab === 'settings'"
              :disabled="isDisabled('settings')">Settings</button>
    </div>
    <div class="tab-content" id="v-pills-tabContent">
      <div v-show="currentTab === 'home'" class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">Home Content
          <button type="button" class="btn btn-primary" @click="NextContent('profile')">Next</button>
      </div>
      <div v-show="currentTab === 'profile'" class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">Profile Content
          <button type="button" class="btn btn-primary" @click="NextContent('home')">Pre</button>
          <button type="button" class="btn btn-primary" @click="NextContent('messages')">Next</button>
      </div>
      <div v-show="currentTab === 'messages'" class="tab-pane fade show active" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">Messages Content
          <button type="button" class="btn btn-primary" @click="NextContent('profile')">Pre</button>
          <button type="button" class="btn btn-primary" @click="NextContent('settings')">Next</button>
      </div>
      <div v-show="currentTab === 'settings'" class="tab-pane fade show active" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">Settings Content
          <button type="button" class="btn btn-primary" @click="NextContent('messages')">Pre</button>
          <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentTab: 'home',
      tabs: ['home', 'profile', 'messages', 'settings'],
      enabledTabs: ['home']
    };
  },
  methods: {
    changeTab(tab) {
      if (this.enabledTabs.includes(tab)) {
        this.currentTab = tab;
      }
    },
    NextContent(tab) {
      this.currentTab = tab;
      if (!this.enabledTabs.includes(tab)) {
        this.enabledTabs.push(tab);
      }
    },
    isDisabled(tab) {
      return !this.enabledTabs.includes(tab);
    }
  }
}
</script>

<style scoped>
.nav-link.active {
  font-weight: bold;
}
</style>
