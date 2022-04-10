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
        icon: 'cil-pencil'
      },
      // angket kebutuhan peserta didik
      {
        _name: 'CSidebarNavTitle',
        _children: ['angket kebutuhan peserta didik']
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Jawaban Peserta Didik',
        to: '/akpd/jawaban',
        icon: 'cil-pencil'
      },
      {
        _name: 'CSidebarNavDropdown',
        name: 'Kelola Soal AKPD',
        icon: 'cil-pencil',
        items: [
          {
            name: 'Soal AKPD',
            to: '/akpd/soal'
          },
          {
            name: 'Bidang Soal',
            to: '/akpd/soal/bidang'
          },
          {
            name: 'Kompetensi Soal',
            to: '/akpd/soal/kompetensi'
          },
        ]
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
        icon: 'cil-pencil'
      },
      {
        _name: 'CSidebarNavItem',
        name: 'Analisis Profil Konseling',
        to: '/analisis/profil-konseling',
        icon: 'cil-pencil'
      },
    ]
  }
]