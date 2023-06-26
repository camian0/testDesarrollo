import { createRouter, createWebHistory } from 'vue-router'
import UserView from '../views/UserView.vue'
import Home from '../views/Home.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/users',
      name: 'users',
      component: UserView
    },
  ]
})

export default router
