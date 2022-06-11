import Vue from 'vue'
import VueRouter from 'vue-router'

// Containers
const TheContainer = () => import('@/containers/TheContainer')

// Views
const DashboardPage = () => import('@/views/DashboardPage')
const IdentitasSekolahPage = () => import('@/views/IdentitasSekolah/IdentitasSekolahPage')
const GuruPage = () => import('@/views/Guru/GuruPage')
const KelasPage = () => import('@/views/Kelas/KelasPage')
const SoalPage = () => import('@/views/SoalAkpd/SoalPage')
const SoalBidangPage = () => import('@/views/SoalBidangAkpd/SoalBidangPage')
const SoalKompetensiPage = () => import('@/views/SoalKompetensiAkpd/SoalKompetensiPage')
const JawabanPage = () => import('@/views/JawabanPeserta/JawabanPage')


// Views - Pages
const Login = () => import('@/views/pages/Login')


Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})

function configRoutes() {
  return [
    // Login
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    // Dashboard
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
          path: '/bio/guru',
          name: 'Guru',
          component: GuruPage
        },
        {
          path: '/bio/kelas',
          name: 'Kelas',
          component: KelasPage
        },
        {
          path: '/akpd/soal',
          name: 'Soal AKPD',
          component: SoalPage,
        },
        {
          path: '/akpd/soal/bidang',
          name: 'Bidang Soal AKPD',
          component: SoalBidangPage
        },
        {
          path: '/akpd/soal/kompetensi',
          name: 'Kompetensi Soal AKPD',
          component: SoalKompetensiPage
        },
        {
          path: '/akpd/jawaban',
          name: 'Jawaban Peserta Didik',
          component: JawabanPage
        },
      ]
    }
  ]
}