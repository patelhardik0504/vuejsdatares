import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes.js'
import store from '../store'

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const user = store.getters.user;
  const requiresAuth = to.matched.some(route => route.meta.guard === 'auth');
  const requiresGuest = to.matched.some(route => route.meta.guard === 'guest');
  
  if (user) {
    // Redirect authenticated users away from guest routes
    if (requiresGuest) {
      next({ name: 'home' });
    } else {
      // Check payment status for authenticated users
      const { submitted, approved } = store.getters.formSubmissionState;

      if (submitted && approved) {
        next();
      } else {
        if (to.path !== '/form') {
          next('/form'); // Redirect to the form page if not submitted/approved
        } else {
          next(); // Stay on the form page
        }
      }
    }
  } else {
    // Redirect unauthenticated users to login for protected routes
    if (requiresAuth) {
      next({ name: 'login' });
    } else {
      next();
    }
  }
});

export default router;
