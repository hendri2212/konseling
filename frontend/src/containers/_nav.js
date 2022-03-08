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
        _children: ['bio sekolah']
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Identitas Sekolah',
        to: '/bio/identitas-sekolah',
        icon: 'cil-drop'
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Kelas',
        to: '/bio/kelas',
        icon: 'cil-pencil'
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Data Peserta Didik',
        to: '/bio/peserta-didik',
        icon: 'cil-school'
      },
      // angket kebutuhan peserta didik
      {
        _name: 'CSidebarNavTitle',
        _children: ['angket kebutuhan peserta didik']
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Kelola Soal AKPD',
        to: '/akpd/soal',
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
        name: 'Analisis Profil Kelas',
        to: '/analisis/profil-kelas',
        icon: 'cib-google-analytics'
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Analisis Profil Konseling',
        to: '/analisis/profil-konseling',
        icon: 'cil-pencil'
      },
      // Component
      {
        _name: 'CSidebarNavTitle',
        _children: ['Components']
      },
      {
        _name: 'CSidebarNavDropdown',
        name: 'Buttons',
        route: '/buttons',
        icon: 'cil-cursor',
        items: [
          {
            name: 'Buttons',
            to: '/buttons/standard-buttons'
          },
          {
            name: 'Button Dropdowns',
            to: '/buttons/dropdowns'
          },
          {
            name: 'Button Groups',
            to: '/buttons/button-groups'
          },
          {
            name: 'Brand Buttons',
            to: '/buttons/brand-buttons'
          }
        ]
      },
    ]
  }
]