import { createRouter, createWebHistory } from 'vue-router'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '',
      name: 'Dashboard',
      component: () => import('../views/Dashboard.vue'),
    },
    {
      path: '/login',
      name: 'Login',
      component: () => import('../views/Login.vue'),
      meta: {
        authentication: true,
      }
    },
    {
      path: '/angket',
      name: "AngketParent",
      component: () => import('../views/AngketParent.vue'),
      children: [
        {
          path: '',
          name: "Angket",
          component: () => import('../views/Angket.vue')
        },
        {
          path: 'attempt',
          name: "Attempt",
          component: () => import('../views/Attempt.vue'),
          meta: {
            angketnavigation: true,
          }
        },
        {
          path: 'summary',
          name: "AttemptSummary",
          component: () => import('../views/Summary.vue'),
          meta: {
            angketnavigation: true,
          }
        },
        {
          path: 'review',
          name: "AttemptReview",
          component: () => import('../views/Review.vue'),
          meta: {
            angketnavigation: true,
          }
        },
      ]
    },
  ]
})

export default router
