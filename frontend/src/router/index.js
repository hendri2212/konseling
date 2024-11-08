import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store/index'


// Views
const Page404 = () => import("@/views/404.vue")
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
// const ProfileKelasParent = () => import('@/views/ProfileKelas/Parent')
// const ProfileKelasPage = () => import('@/views/ProfileKelas/Page')
// const ProfileKelasPerKelasPage = () => import('@/views/ProfileKelas/PerKelasPage')
// const ProfileKelasPerAngketPage = () => import('@/views/ProfileKelas/PerAngketPage')
const Angket = () => import('@/views/Angket/Angket')
const AngketDetail = () => import('@/views/Angket/AngketDetail')
const HasilAngket = () => import('@/components/Angket/Hasil')
const HasilPerButirAngket = () => import('@/components/Angket/HasilPerButirAngket')
// const RplKlasikal = () => import('@/components/Angket/RplKlasikal/RplKlasikal')
const ListRplKlasikal = () => import('@/components/Angket/Rpl/Klasikal/ListRpl')
const AddRplKlasikal = () => import('@/components/Angket/Rpl/Klasikal/AddRpl')
const PrintRplKlasikal = () => import('@/components/Angket/Rpl/Klasikal/PrintRpl')


// Views - Pages
const Login = () => import('@/views/pages/Login')
const AdminLogin = () => import('@/views/pages/AdminLogin')


Vue.use(VueRouter)

function configRoutes() {
  return [
    // error page
    {
      path: "/404",
      name: "Error404",
      component: Page404,
    },
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
      alias: ['/dashboard', '/home'],
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
          meta: {
            requiredAdmin: true,
            requiredLogin: true
          },
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
            label: "SKKPD",
            requiredAdmin: true,
            requiredLogin: true
          }
        },
        {
          path: 'skkpd',
          component: ParentPage,
          meta: {
            label: "SKKPD",
            requiredAdmin: true,
            requiredLogin: true
          },
          children: [
            {
              path: 'rumusan-kebutuhan',
              name: 'RumusanKebutuhan',
              component: RumusanKebutuhanPage,
              meta: {
                label: "Rumusan Kebutuhan",
                requiredAdmin: true,
                requiredLogin: true
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
      component: () => import('../views/Siswa/SiswaPage.vue'),
      meta: {
        requiredLogin: true
      },
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
    // {
    //   path: '/analisis',
    //   component: ProfileKelasParent,
    //   meta: {
    //     requiredLogin: true
    //   },
    //   children: [
    //     {
    //       path: '/',
    //       name: 'Analisis Profile Kelas Home',
    //       component: ProfileKelasPage,
    //     },
    //     {
    //       path: 'kelas/:id',
    //       name: 'Analisis Profile Kelas View',
    //       component: ProfileKelasPerKelasPage,
    //     },
    //     {
    //       path: 'angket/:id/butir',
    //       name: 'Analisis Profil Tiap Butir Soal',
    //       component: ProfileKelasPerAngketPage,
    //       meta: {
    //         type: 'butir',
    //       },
    //     },
    //     {
    //       path: 'angket/:id/siswa',
    //       name: 'Analisis Profile Tiap Siswa',
    //       component: ProfileKelasPerAngketPage,
    //       meta: {
    //         type: 'siswa',
    //       },
    //     },
    //   ]
    // },
    {
      path: '/angket',
      name: "Angket",
      component: Angket,
      meta: {
        requiredLogin: true
      },
    },
    {
      path: '/angket',
      name: "AngketDetail",
      component: AngketDetail,
      redirect: { path: "/angket/analisis-siswa" },
      meta: {
        requiredLogin: true
      },
      children: [
        {
          path: 'analisis-siswa',
          name: "Hasil",
          component: HasilAngket,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: 'analisis-butir',
          name: "HasilPerButir",
          component: HasilPerButirAngket,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: 'rpl-klasikal',
          name: "ListRplKlasikal",
          component: ListRplKlasikal,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: 'rpl-klasikal/tambah',
          name: "AddRplKlasikal",
          component: AddRplKlasikal,
          meta: {
            requiredLogin: true
          },
        },
        {
          path: 'rpl-klasikal/cetak',
          name: "CetakRplKlasikal",
          component: PrintRplKlasikal,
          meta: {
            requiredLogin: true
          },
        },
        // {
        //   path: 'rpl-kelompok',
        //   name: "ListRplKelompok",
        //   component: ListRpl,
        //   props: {
        //     service_strategy: "kelompok"
        //   },
        //   meta: {
        //     requiredLogin: true
        //   },
        // },
        // {
        //   path: 'rpl-kelompok/tambah',
        //   name: "AddRplKelompok",
        //   component: AddRpl,
        //   props: {
        //     service_strategy: "kelompok"
        //   },
        //   meta: {
        //     requiredLogin: true
        //   },
        // }
      ]
    },
  ]
}

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes(),
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiredLogin)) {
    if (store.getters['auth/isAuthenticated']) {
      next()
      return
    }
    next({ name: "Login" })
  } else {
    next()
  }
})
export default router