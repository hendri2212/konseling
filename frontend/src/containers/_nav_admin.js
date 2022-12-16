export default [
  {
    _name: 'CSidebarNav',
    _children: [
      {
        _name: 'CSidebarNavItem',
        name: 'Dashboard',
        to: '/dashboard',
        icon: 'cil-speedometer'
      },
      // Kelola AKPD
      {
        _name: 'CSidebarNavDropdown',
        name: 'Kelola AKPD',
        icon: 'cil-notes',
        items: [
          {
            name: 'Komponen Layanan',
            to: '/akpd/komponen-layanan'
          },
          {
            name: 'Bidang Layanan',
            to: '/akpd/bidang-layanan'
          },
          {
            name: 'Butir Angket Konseling',
            to: '/akpd/butir-angket-konseling'
          },
        ]
      },
      // angket kebutuhan peserta didik
      // {
      //   _name: 'CSidebarNavTitle',
      //   _children: ['angket kebutuhan peserta didik']
      // },
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'Angket',
      //   to: '/angket',
      //   icon: 'cil-pencil'
      // },
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'Jawaban Peserta Didik',
      //   to: '/akpd/jawaban',
      //   icon: 'cil-pencil'
      // },
      // // hasil analisis
      // {
      //   _name: 'CSidebarNavTitle',
      //   _children: ['hasil analisis']
      // },
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'Analisis Profile',
      //   to: '/analisis',
      //   icon: 'cil-chart'
      // },
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'Analisis Profile Konseling',
      //   to: '/analisis/profile-konseling',
      //   icon: 'cil-chart-line'
      // },
    ]
  }
]