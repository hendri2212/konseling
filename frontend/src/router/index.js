import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store/index'

// Containers
const TheContainer = () => import('@/containers/TheContainer')

// Views
const DashboardPage = () => import('@/views/DashboardPage')
const ParentPage = () => import('@/views/Parent')
const KomponenLayananPage = () => import('@/views/KomponenLayanan/KomponenLayananPage')
const MateriPage = () => import('@/views/KomponenLayanan/Materi/MateriPage')
const BidangLayananPage = () => import('@/views/BidangLayanan/BidangLayananPage')
const SkkpdPage = () => import('@/views/BidangLayanan/Skkpd/SkkpdPage')
const RumusanKebutuhanPage = () => import('@/views/BidangLayanan/Skkpd/RumusanKebutuhan/RumusanKebutuhanPage')
const IdentitasSekolahPage = () => import('@/views/IdentitasSekolah/IdentitasSekolahPage')
const GuruPage = () => import('@/views/Guru/GuruPage')
const KelasPage = () => import('@/views/Kelas/KelasPage')
const Assign = () => import('@/views/Kelas/Assign')
const SoalPage = () => import('@/views/SoalAkpd/SoalPage')
const JawabanPage = () => import('@/views/JawabanPeserta/JawabanPage')
const ProfileKelasParent = () => import('@/views/ProfileKelas/Parent')
const ProfileKelasPage = () => import('@/views/ProfileKelas/Page')
const ProfileKelasPerKelasPage = () => import('@/views/ProfileKelas/PerKelasPage')
const ProfileKelasPerAngketPage = () => import('@/views/ProfileKelas/PerAngketPage')
const Angket = () => import('@/views/Angket/AngketPage')


// Views - Pages
const Login = () => import('@/views/pages/Login')
const AdminLogin = () => import('@/views/pages/AdminLogin')


Vue.use(VueRouter)

function configRoutes() {
  return [
    // Login Admin
    {
      path: '/secret-page/login',
      name: 'AdminLogin',
      component: AdminLogin,
      meta: {
        requiredNotLogin: true
      }
    },
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
            requiredLogin: true
          },
        },
        {
          path: '/akpd/komponen-layanan',
          name: 'KomponenLayanan',
          component: KomponenLayananPage,
          meta: {
            label: 'Komponen Layanan',
            requiredAdmin: true,
            requiredLogin: true
          },
        },
        {
          path: '/akpd/komponen-layanan',
          component: ParentPage,
          meta: {
            label: 'Komponen Layanan',
            requiredAdmin: true,
            requiredLogin: true
          },
          children: [
            {
              path: 'materi',
              name: 'Materi',
              component: MateriPage,
            },
          ]
        },
        {
          path: '/akpd/bidang-layanan',
          name: 'BidangLayanan',
          component: BidangLayananPage,
          meta: {
            label: "Bidang Layanan",
            requredAdmin: true,
            requiredLogin: true
          },
        },
        {
          path: '/akpd/bidang-layanan',
          component: ParentPage,
          meta: {
            label: 'Bidang Layanan',
            requiredAdmin: true,
            requiredLogin: true
          },
          children: [
            {
              path: 'skkpd',
              name: 'Skkpd',
              component: SkkpdPage,
              meta: {
                label: "SKKPD"
              }
            },
            {
              path: 'skkpd',
              component: ParentPage,
              meta: {
                label: "SKKPD"
              },
              children: [
                {
                  path: 'rumusan-kebutuhan',
                  name: 'RumusanKebutuhan',
                  component: RumusanKebutuhanPage,
                  meta: {
                    label: "Rumusan Kebutuhan"
                  }
                },
              ]
            },

          ]
        },
        {
          path: '/akpd/butir-angket-konseling',
          name: 'ButirAngket',
          component: SoalPage,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: '/bio/identitas-sekolah',
          name: 'Identitas Sekolah',
          component: IdentitasSekolahPage,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: '/bio/guru',
          name: 'Guru',
          component: GuruPage,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: '/bio/peserta-didik',
          name: 'Peserta Didik',
          component: () => import('../views/Siswa/SiswaPage.vue')
        },
        {
          path: '/bio/kelas',
          name: 'Kelas',
          component: KelasPage,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: '/bio/kelas/assign',
          name: 'AssignSiswa',
          component: Assign,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: '/akpd/jawaban',
          name: 'Jawaban Peserta Didik',
          component: JawabanPage,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: '/analisis',
          component: ProfileKelasParent,
          children: [
            {
              path: '/',
              name: 'Analisis Profile Kelas Home',
              component: ProfileKelasPage,
              meta: {
                requiredLogin: true
              },
            },
            {
              path: 'kelas/:id',
              name: 'Analisis Profile Kelas View',
              component: ProfileKelasPerKelasPage,
              meta: {
                requiredLogin: true
              },
            },
            {
              path: 'angket/:id/butir',
              name: 'Analisis Profil Tiap Butir Soal',
              component: ProfileKelasPerAngketPage,
              meta: {
                requiredLogin: true,
                type: 'butir',
              },
            },
            {
              path: 'angket/:id/siswa',
              name: 'Analisis Profile Tiap Siswa',
              component: ProfileKelasPerAngketPage,
              meta: {
                requiredLogin: true,
                type: 'siswa',
              },
            },
          ]
        },
        {
          path: '/angket',
          name: 'Angket',
          component: Angket,
          meta: {
            requiredLogin: true
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
  } else if (store.getters['auth/isAuthenticated'] && to.meta.requiredNotLogin) {
    next({ name: 'Home' })
  }
  next()
})
export default router