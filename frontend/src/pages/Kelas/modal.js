import React, { useState } from 'react';
import { Button, Modal, Form } from 'react-bootstrap';

function ModalForm(props) {
  const [modal, setModal] = useState(false);

  const toggle = () => {
    setModal(!modal);
  };

  const closeBtn = (
    <Button variant="secondary" onClick={toggle}>
      &times;
    </Button>
  );

  const label = props.buttonLabel

  let button = '';
  let title = '';

  if (label === 'Edit') {
    button = (
      <Button variant="warning" onClick={toggle} style={{marginRight:"10px"}}>
        {label}
      </Button>
    );
    title = 'Edit Item';
  } else {
    button = (
      <Button variant="success" onClick={toggle}>
        {label}
      </Button>
    );
    title = 'Add New Item';
  }

  return (
    <>
      {button}
      <Modal
        show={modal}
        onHide={toggle}
        backdrop="static"
        keyboard={false}>
        <Modal.Header>
          <Modal.Title>id: {props.item.id}</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <Form>
            <Form.Group controlId="formBasicEmail">
              <Form.Label>Kelas</Form.Label>
              <Form.Control type="text" placeholder="Enter kelas" value={props.item.kelas} />
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
          <Button variant="secondary" onClick={toggle}>
            Close
          </Button>
        </Modal.Footer>
      </Modal>
    </>
  );
}

export default ModalForm;