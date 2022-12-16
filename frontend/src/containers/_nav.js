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
      // bio sekolah
      {
        _name: 'CSidebarNavTitle',
        _children: ['Data Umum']
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Identitas Sekolah',
        to: '/bio/identitas-sekolah',
        icon: 'cil-institution'
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Guru',
        to: '/bio/guru',
        icon: 'cil-school'
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Data Peserta Didik',
        to: '/bio/peserta-didik',
        icon: 'cil-people'
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Kelas',
        to: '/bio/kelas',
        icon: 'cil-school'
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