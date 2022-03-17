<template>
  <CModal title="Add Edit Kelas" color="primary" :show.sync="showModal">
    <CRow>
      <CCol sm="12">
        <CInput
          label="Kelas"
          placeholder="Masukkan Kelas"
          v-model="data.kelas"
        />
      </CCol>
      <CCol sm="12">
        <CInput
          type="number"
          label="Tahun"
          placeholder="Masukkan Tahun"
          v-model="data.year"
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
        kelas: null,
        year: null,
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
        this.data.kelas = null;
        this.data.year = null;
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