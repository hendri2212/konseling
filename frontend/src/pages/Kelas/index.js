import PageHeading from "../../components/PageHeading";

//Navigation
import Sidebar from '../../components/Navigation/Sidebar';
import Topbar from '../../components/Navigation/Topbar';
import CardDefault from "../../components/Cards/Default";

function Kelas() {

    // raw data
    const data = [
        {
            id: 1,
            kelas: '10',
            year: '2021',
        },
        {
            id: 2,
            kelas: '11',
            year: '2021',
        },
        {
            id: 3,
            kelas: '12',
            year: '2021',
        },
    ];

    // data mapping & table body
    const tableBody = data.map((item) =>
        <tr>
            <th scope="row">{item.id}</th>
            <td>{item.kelas}</td>
            <td></td>
        </tr>
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

                            <PageHeading title="Data Kelas" />

                            {/* <!-- Content Row --> */}

                            <div className="row">
                                <div class="col-lg-12">
                                    <CardDefault title="SMK Negeri 1 Kotabaru">
                                        <table className="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kelas</th>
                                                    <th scope="col">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {tableBody}
                                            </tbody>
                                        </table>
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

export default Kelas;