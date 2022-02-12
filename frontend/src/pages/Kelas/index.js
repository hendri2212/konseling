import { Component } from "react";
import PageHeading from "../../components/PageHeading";

//Navigation
import Sidebar from '../../components/Navigation/Sidebar';
import Topbar from '../../components/Navigation/Topbar';
import CardDefault from "../../components/Cards/Default";
import DataTable from "react-data-table-component";

function Kelas() {
    const columns = [
        {
            name: 'Kelas',
            selector: row => row.kelas,
        },
    ];
    
    const data = [
        {
            id: 1,
            kelas: '7',
            year: '1988',
        },
        {
            id: 2,
            kelas: '8',
            year: '1984',
        },
    ];
    
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
                                    <CardDefault title="Card Default Example">
                                        <DataTable
                                            columns={columns}
                                            data={data}
                                            pagination
                                        />
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