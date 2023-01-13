import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '@/views/TestLogin.vue'
import Dashboard from '@/views/Dashboard.vue'
import Home from '@/views/Angket/Home.vue'
import store from '@/store/index'

Vue.use(VueRouter)

const routes = [
  {
    path      : '/login',
    name      : 'login',
    component : Login,
  },
  {
    path      : '/dashboard',
    alias: '',
    name      : 'dashboard',
    component : Dashboard,
    meta: {
      requiredLogin: true
    }
  },
  {
    path      : '/akpd/:id',
    name      : 'Soal',
    component : Home,
    meta: {
      requiredLogin:true
    }
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (!store.getters['auth/isAuthenticated'] && to.meta.requiredLogin) {
    next({ name: 'login' })
  }else if(store.getters['auth/isAuthenticated'] && to.meta.requiredNotLogin){
    next({name: 'dashboard'})
  }
  next()
})

export default router
