import PageHeading from "../../components/PageHeading";
import Sidebar from '../../components/Navigation/Sidebar';
import Topbar from '../../components/Navigation/Topbar';
import CardDefault from "../../components/Cards/Default";

function IdentitasSekolah() {

    // raw data
    const data = [
        {head: 'pemerintah', body: 'Lorem Ipsum'},
        {head: 'dinas', body: 'Lorem Ipsum'},
        {head: 'nama sekolah', body: 'SMK Negeri 1 Kotabaru'},
        {head: 'alamat', body: 'Lorem Ipsum'},
        {head: 'nama kepala sekolah', body: 'Lorem Ipsum'},
    ];

    // data mapping
    const listItem = data.map((item) =>
        <div>
            <p className="h6 text-capitalize font-weight-bold">{item.head}</p>
            <p>{item.body}</p>
            <div class="dropdown-divider"></div>
        </div>
    );

    return (
        <div>
            <div id="wrapper">

                {/* Sidebar */}
                <Sidebar />

                <div id="content-wrapper" className="d-flex flex-column">
                    <div id="content">
                        {/* <!-- Topbar --> */}
                        <Topbar />
                        {/* <!-- End of Topbar --> */}

                        {/* <!-- Begin Page Content --> */}
                        <div className="container-fluid">
                            {/* <!-- Page Heading --> */}

                            <PageHeading title="Identitas Sekolah" />

                            {/* <!-- Content Row --> */}
                            <div className="row">
                                <div class="col-lg-12">
                                    <CardDefault title="Sekolah">

                                        {/* List Item - Identitas Sekolah */}
                                        {listItem}

                                    </CardDefault>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default IdentitasSekolah;