import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store/index'

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
const ProfileKelasParent = () => import('@/views/ProfileKelas/Parent')
const ProfileKelasPage = () => import('@/views/ProfileKelas/Page')
const ProfileKelasPerKelasPage = () => import('@/views/ProfileKelas/PerKelasPage')
const ProfileKelasPerUjianPage = () => import('@/views/ProfileKelas/PerUjianPage')
const Ujian = () => import('@/views/Ujian/UjianPage')


// Views - Pages
const Login = () => import('@/views/pages/Login')


Vue.use(VueRouter)

function configRoutes() {
  return [
    // Login
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: {
        requiredNotLogin: true
      }
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
          component: DashboardPage,
          meta: {
            requiredLogin:true
          },
        },
        {
          path: '/bio/identitas-sekolah',
          name: 'Identitas Sekolah',
          component: IdentitasSekolahPage,
          meta: {
            requiredLogin:true
          },
        },
        {
          path: '/bio/guru',
          name: 'Guru',
          component: GuruPage,
          meta: {
            requiredLogin:true
          },
        },
        {
          path: '/bio/kelas',
          name: 'Kelas',
          component: KelasPage,
          meta: {
            requiredLogin:true
          },
        },
        {
          path: '/akpd/soal',
          name: 'Soal AKPD',
          component: SoalPage,
          meta: {
            requiredLogin:true
          },
        },
        {
          path: '/akpd/soal/bidang',
          name: 'Bidang Soal AKPD',
          component: SoalBidangPage,
          meta: {
            requiredLogin:true
          },
        },
        {
          path: '/akpd/soal/kompetensi',
          name: 'Kompetensi Soal AKPD',
          component: SoalKompetensiPage,
          meta: {
            requiredLogin:true
          },
        },
        {
          path: '/akpd/jawaban',
          name: 'Jawaban Peserta Didik',
          component: JawabanPage,
          meta: {
            requiredLogin:true
          },
        },
        {
          path:'/analisis',
          component: ProfileKelasParent,
          children: [
            {
              path: '/',
              name: 'Analisis Profile Kelas Home',
              component: ProfileKelasPage,
              meta: {
                requiredLogin:true
              },
            },
            {
              path: 'kelas/:id',
              name: 'Analisis Profile Kelas View',
              component: ProfileKelasPerKelasPage,
              meta: {
                requiredLogin:true
              },
            },
            {
              path: 'ujian/:id/butir',
              name: 'Analisis Profil Tiap Butir Soal',
              component: ProfileKelasPerUjianPage,
              meta: {
                requiredLogin:true,
                type:'butir',
              },
            },
            {
              path: 'ujian/:id/siswa',
              name: 'Analisis Profile Tiap Siswa',
              component: ProfileKelasPerUjianPage,
              meta: {
                requiredLogin:true,
                type:'siswa',
              },
            },
          ]
        },
        {
          path: '/ujian',
          name: 'Ujian',
          component: Ujian,
          meta: {
            requiredLogin:true
          },
        },
      ]
    }
  ]
}

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes(),
})
router.beforeEach((to, from, next) => {
  if (!store.getters['auth/isAuthenticated'] && to.meta.requiredLogin) {
    next({ name: 'Login' })
  }else if(store.getters['auth/isAuthenticated'] && to.meta.requiredNotLogin){
    next({name: 'Home'})
  }
  next()
})
export default router