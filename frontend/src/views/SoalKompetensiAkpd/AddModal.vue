<template>
  <CModal title="Add Edit Kelas" color="primary" :show.sync="showModal">
    <CRow>
      <CCol sm="12">
        <CInput
          label="SKKPD"
          placeholder="Masukkan SKKPD"
          v-model="data.skkpd"
        />
      </CCol>
      <CCol sm="12">
        <CInput
          label="Pengenalan"
          placeholder="Masukkan Pengenalan"
          v-model="data.pengenalan"
        />
      </CCol>
      <CCol sm="12">
        <CInput
          label="Akomodasi"
          placeholder="Masukkan Akomodasi"
          v-model="data.akomodasi"
        />
      </CCol>
      <CCol sm="12">
        <CInput
          label="Tindakan"
          placeholder="Masukkan Tindakan"
          v-model="data.tindakan"
        />
      </CCol>
    </CRow>

    <template #footer>
      <CButton color="secondary" @click="showModal = false">Close</CButton>
      <CButton color="primary" @click="save">Save</CButton>
    </template>
  </CModal>
</template>

<script>
export default {
  name: "AddModal",
  data() {
    return {
      data: {
        id: null,
        skkpd: null,
        pengenalan: null,
        akomodasi: null,
        tindakan: null,
      },
      insertModal: true,
      showModal: false,
    };
  },
  methods: {
    setModal(stat, data = null) {
      this.showModal = stat;
      if (data != null) {
        this.insertModal = false;
        this.data = data;
      } else {
        this.insertModal = true;
        this.data.id = null;
        this.data.skkpd = null;
        this.data.pengenalan = null;
        this.data.akomodasi = null;
        this.data.tindakan = null;
      }
    },
    save() {
      if (this.insertModal) {
        console.log(this.data);
      } else {
        console.log("edit");
        console.log(this.data);
      }
    },
  },
};
</script>

<style>
</style>