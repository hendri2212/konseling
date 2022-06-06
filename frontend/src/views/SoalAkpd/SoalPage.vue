<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Soal AKPD

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Soal</CButton>

          <SoalModal ref="addModal"></SoalModal>
        </div>
      </CCardHeader>

      <CCardBody>
        <CDataTable
          :items="items"
          :fields="fields"
          column-filter
          table-filter
          items-per-page-select
          :items-per-page="5"
          hover
          sorter
          pagination
        >
          <template #actions="{ item }">
            <div class="py-2 d-flex justify-content-center">
              <CButton size="sm" color="info" @click="$refs.addModal.setModal(true, item)"> Edit </CButton>
              <CButton size="sm" color="danger" class="ml-1" @click="(deleteData.id = item.id), (deleteData.modal = true)">
                Delete
              </CButton>
            </div>
          </template>
        </CDataTable>

        <CModal title="Hapus Soal" color="danger" :show.sync="deleteData.modal">
          {{ deleteData.id }} delete Permanent?
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
            <CButton @click="deleteSoal">Yes</CButton>
          </template>
        </CModal>
      </CCardBody>
    </CCard>
  </div>
</template>

<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
import SoalModal from "./SoalModal.vue";

// data items
const itemsx = [
  {
    no: 1,
    soal: "Soal 1",
    rumusan_kebutuhan: "Rumusan Kebutuhan 1",
    materi: "materi 1",
    tujuan_layanan: "tujuan layanan 1",
    komponen_layanan: "komponen layanan 1",
    nama_bidang: "Bidang 1",
    kompetensi: "Kompetensi 1",
  },
  {
    no: 2,
    soal: "Soal 2",
    rumusan_kebutuhan: "Rumusan Kebutuhan 2",
    materi: "materi 2",
    tujuan_layanan: "tujuan layanan 2",
    komponen_layanan: "komponen layanan 2",
    nama_bidang: "Bidang 2",
    kompetensi: "Kompetensi 2",
  },
  {
    no: 3,
    soal: "Soal 3",
    rumusan_kebutuhan: "Rumusan Kebutuhan 3",
    materi: "materi 3",
    tujuan_layanan: "tujuan layanan 3",
    komponen_layanan: "komponen layanan 3",
    nama_bidang: "Bidang 3",
    kompetensi: "Kompetensi 3",
  }
];

// fields
const fields = [
  // { key: "no", _style: "width:1%" },
  { key: "id", _style: "width:1%" },
  "soal",
  "rumusan_kebutuhan",
  "materi",
  "tujuan_layanan",
  "komponen_layanan",
  // "nama_bidang",
  "bidang_id",
  // "kompetensi",
  "kompetensi_id",
  {
    key: "actions",
    label: "",
    sorter: false,
    filter: false
  },
];

export default {
  name: "SoalPage",
  components: {
    SoalModal,
  },
  data() {
    return {
      // items: items.map((item, id) => {
      //   return { ...item, id };
      // }),
      items: [],
      fields,
      details: [],
      collapseDuration: 0,
      deleteData: {
        id: null,
        modal: false,
      },
    };
  },
  created() {
    axios
    // .get(this.$store.state.url + 'soal')
    .get('http://127.0.0.1:8000/api/soal')
    .then(response => {
      this.items = response.data.data
    })
  },
  methods: {
    toggleDetails(item) {
      this.$set(this.items[item.id], "_toggled", !item._toggled);
      this.collapseDuration = 300;
      this.$nextTick(() => {
        this.collapseDuration = 0;
      });
    },
    deleteSoal() {
      console.log(this.deleteData.id);
      // di sini fungsi axios

      // hapus data di frontend
      this.items.splice(this.deleteData.id, 1);

      this.deleteData.modal = false;
    },
  },
};
</script>

<style>
</style>