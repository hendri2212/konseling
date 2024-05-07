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
      // Rencana Pelaksanaan Layanan (RPL)
      // {
      //   _name: 'CSidebarNavTitle',
      //   _children: ['Rencana Pelaksanaan Layanan (RPL)']
      // },
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'RPL Individual',
      //   to: '/analisis',
      //   icon: 'cil-chart'
      // },
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'RPL Klasikal',
      //   to: '/analisis',
      //   icon: 'cil-chart'
      // },
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'RPL Kelompok',
      //   to: '/analisis',
      //   icon: 'cil-chart'
      // },
      // {
      //   _name: 'CSidebarNavItem',
      //   name: 'RPL Kelas Besar',
      //   to: '/analisis',
      //   icon: 'cil-chart'
      // },
    ]
  }
]