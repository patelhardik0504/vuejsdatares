<template>
    <div>
      <ul>
        <li v-for="post in posts.data" :key="post.id">{{ post.title }}</li>
      </ul>
      <div>
        <button @click="fetchPosts(posts.prev_page_url)" :disabled="!posts.prev_page_url">Previous</button>
        <button @click="fetchPosts(posts.next_page_url)" :disabled="!posts.next_page_url">Next</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        posts: {}
      };
    },
    created() {
      this.fetchPosts();
    },
    methods: {
      fetchPosts(url = 'http://127.0.0.1:8000/api/posts') {
        axios.get(url).then(response => {
          this.posts = response.data;
        });
      }
    }
  };
  </script>
  