import Vue from 'vue'
import Router from 'vue-router'

// Containers
const TheContainer = () => import('@/containers/TheContainer')

// Views
const DashboardPage = () => import('@/views/DashboardPage')
const IdentitasSekolahPage = () => import('@/views/IdentitasSekolah/IdentitasSekolahPage')
const KelasPage = () => import('@/views/Kelas/KelasPage')
const SoalPage = () => import('@/views/SoalAkpd/SoalPage')
const JawabanPage = () => import('@/views/JawabanPeserta/JawabanPage')

Vue.use(Router)

export default new Router({
  mode: 'hash', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})

function configRoutes() {
  return [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: TheContainer,
      children: [
        {
          path: 'dashboard',
          name: 'DashboardPage',
          component: DashboardPage
        },
        {
          path: '/bio/identitas-sekolah',
          name: 'Identitas Sekolah',
          component: IdentitasSekolahPage
        },
        {
          path: '/bio/kelas',
          name: 'Kelas',
          component: KelasPage
        },
        {
          path: '/akpd/soal',
          name: 'Soal AKPD',
          component: SoalPage
        },
        {
          path: '/akpd/jawaban',
          name: 'Jawaban Peserta Didik',
          component: JawabanPage
        },
        // {
        //   path: 'buttons',
        //   redirect: '/buttons/standard-buttons',
        //   name: 'Buttons',
        //   component: {
        //     render (c) { return c('router-view') }
        //   },
        //   children: [
        //     {
        //       path: 'standard-buttons',
        //       name: 'Standard Buttons',
        //       component: StandardButtons
        //     },
        //     {
        //       path: 'button-groups',
        //       name: 'Button Groups',
        //       component: ButtonGroups
        //     },
        //     {
        //       path: 'dropdowns',
        //       name: 'Dropdowns',
        //       component: Dropdowns
        //     },
        //     {
        //       path: 'brand-buttons',
        //       name: 'Brand Buttons',
        //       component: BrandButtons
        //     }
        //   ]
        // },
      ]
    },
  ]
}