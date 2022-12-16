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
      // angket kebutuhan peserta didik
      {
        _name: 'CSidebarNavTitle',
        _children: ['angket kebutuhan peserta didik']
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Angket',
        to: '/angket',
        icon: 'cil-pencil'
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Jawaban Peserta Didik',
        to: '/akpd/jawaban',
        icon: 'cil-pencil'
      },
      // hasil analisis
      {
        _name: 'CSidebarNavTitle',
        _children: ['hasil analisis']
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Analisis Profile',
        to: '/analisis',
        icon: 'cil-chart'
      },
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'Analisis Profile Konseling',
      //   to: '/analisis/profile-konseling',
      //   icon: 'cil-chart-line'
      // },
    ]
  }
]