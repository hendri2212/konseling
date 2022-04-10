<template>
  <CModal title="Add Edit Kelas" color="primary" :show.sync="showModal">
    <CRow>
      <CCol sm="12">
        <CInput
          label="Bidang"
          placeholder="Masukkan Bidang"
          v-model="data.bidang"
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
        bidang: null,
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
        this.data.bidang = null;
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