import React, { Component } from 'react';
import {Link} from 'react-router-dom';

import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import { clickMenuOpen } from '../../../redux/actions';

class Sidebar extends Component {
  // componentDidMount() {
  //   document.getElementById('body').className = 'page-top';
  // }
  // state = {
  //   sidebarToggled: false,
  // }

  // handleSideBarToggle() {
  //   if (this.sidebarToogled === true) {
  //     this.setState({ sidebarToggled: !this.state.sidebarToggled });
  //     document.getElementById('body').className = 'page-top sidebar-toggled';
  //   } else {
  //     this.setState({ sidebarToggled: !this.state.sidebarToggled });
  //     document.getElementById('body').className = 'page-top';
  //   }

  // }

  render() {
    const { clickMenuOpen, toggled } = this.props;
    return (
      <ul className={toggled ? 'navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled' : 'navbar-nav bg-gradient-primary sidebar sidebar-dark accordion'} id="accordionSidebar">

        {/* <!-- Sidebar - Brand --> */}
        <a className="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div className="sidebar-brand-icon rotate-n-15">
            <i className="fas fa-book"></i>
          </div>
          <div className="sidebar-brand-text mx-3">Konseling</div>
        </a>

        {/* <!-- Divider --> */}
        <hr className="sidebar-divider my-0" />

        {/* <!-- Nav Item - Dashboard --> */}
        <li className="nav-item">
          <Link className="nav-link" to="/dashboard">
            <i className="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></Link>
        </li>

        {/* <!-- Divider --> */}
        <hr className="sidebar-divider" />

        {/* <!-- Heading --> */}
        <div className="sidebar-heading">
          Bio Sekolah
        </div>

        {/* <!-- Nav Item - Identitas Sekolah --> */}
        <li className="nav-item">
          <Link className="nav-link" to="/identitas-sekolah">
            <i className="fas fa-fw fa-chart-area"></i>
            <span>Identitas Sekolah</span>
          </Link>
        </li>

        {/* <!-- Nav Item - Data Siswa --> */}
        <li className="nav-item">
          <Link className="nav-link" to="/identitas-sekolah">
            <i className="fas fa-fw fa-chart-area"></i>
            <span>Data Siswa</span>
          </Link>
        </li>

        {/* <!-- Divider --> */}
        <hr className="sidebar-divider" />

        {/* <!-- Heading --> */}
        <div className="sidebar-heading">
          Angket Kebutuhan Peserta Didik
        </div>

        {/* <!-- Nav Item - Kelola AKPD --> */}
        <li className="nav-item">
          <Link className="nav-link" to="/">
            <i className="fas fa-fw fa-chart-area"></i>
            <span>Kelola Butir AKPD</span>
          </Link>
        </li>

        <li className="nav-item">
          <Link className="nav-link" to="/">
            <i className="fas fa-fw fa-chart-area"></i>
            <span>Kelola jawaban Peserta Didik</span>
          </Link>
        </li>

        {/* <!-- Divider --> */}
        <hr className="sidebar-divider" />

        {/* <!-- Heading --> */}
        <div className="sidebar-heading">
          Hasil Analisis
        </div>

        {/* <!-- Nav Item - Profil Kelas --> */}
        <li className="nav-item">
          <Link className="nav-link" to="/charts">
            <i className="fas fa-fw fa-chart-area"></i>
            <span>Profil Kelas</span>
          </Link>
        </li>

        {/* <!-- Nav Item - Profil Konseling --> */}
        <li className="nav-item">
          <Link className="nav-link" to="/charts">
            <i className="fas fa-fw fa-chart-area"></i>
            <span>Profil Konseling</span>
          </Link>
        </li>

        {/* <!-- Divider --> */}
        <hr className="sidebar-divider d-none d-md-block" />

        {/* <!-- Nav Item - Pages Collapse Menu --> */}
        {/* <li className="nav-item">

          <a className='nav-link collapsed' href="#" data-toggle="collapse" data-target="#collapseTwo"  aria-controls="collapseTwo">
            <i className="fas fa-fw fa-cog"></i>
            <span>Components</span>
          </a>
          <div id="collapseTwo" className='collapse' aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div className="bg-white py-2 collapse-inner rounded">
              <h6 className="collapse-header">Custom Components:</h6>
              <a className="collapse-item" href="buttons.html">Buttons</a>
              <Link className="collapse-item" to="/cards">Cards</Link>
            </div>
          </div>
        </li> */}

        {/* <!-- Nav Item - Charts --> */}
        {/* <li className="nav-item">
          <Link className="nav-link" to="/charts">
            <i className="fas fa-fw fa-chart-area"></i>
            <span>Charts</span>
          </Link>
        </li> */}

        {/* <!-- Sidebar Toggler (Sidebar) --> */}
        <div className="text-center d-none d-md-inline">
          <button onClick={() => { clickMenuOpen() }} className="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>)
  }
}

const mapDispatchToProps = dispatch =>
  bindActionCreators({ clickMenuOpen }, dispatch);

const mapStateToProps = store => ({
  toggled: store.menuState.menuOpen
});

export default connect(mapStateToProps, mapDispatchToProps)(Sidebar);