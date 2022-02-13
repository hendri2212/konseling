import { useState } from "react";
import PageHeading from "../../components/PageHeading";
import { Button, Modal, Form } from 'react-bootstrap';

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


    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    // data mapping & table body
    const tableBody = data.map((item) =>
        <tr>
            <th scope="row">{item.id}</th>
            <td>{item.kelas}</td>
            <td>
                <Button variant="warning" onClick={handleShow}>
                    Edit
                </Button>

                <Modal
                    show={show}
                    onHide={handleClose}
                    backdrop="static"
                    keyboard={false}>
                    <Modal.Header>
                        <Modal.Title>id: {item.id}</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>
                        <Form>
                            <Form.Group controlId="formBasicEmail">
                                <Form.Label>Kelas</Form.Label>
                                <Form.Control type="text" placeholder="Enter kelas" />
                                <Form.Text className="text-muted">
                                    Masukkan nama kelas.
                                </Form.Text>
                            </Form.Group>
                            <Form.Group controlId="formBasicCheckbox">
                                <Form.Check type="checkbox" label="Check me out" />
                            </Form.Group>
                            <Button variant="primary" type="submit">
                                Submit
                            </Button>
                        </Form>
                    </Modal.Body>
                    <Modal.Footer>
                        <Button variant="secondary" onClick={handleClose}>
                            Close
                        </Button>
                    </Modal.Footer>
                </Modal>
            </td>
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
                                <div className="col-lg-12">
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