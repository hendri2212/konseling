<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Kompetensi Soal AKPD

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)"
            >Tambah Kompetensi</CButton
          >
          <AddModal ref="addModal"></AddModal>
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
            <td class="py-2">
              <CButton
                size="sm"
                color="info"
                @click="$refs.addModal.setModal(true, item)"
              >
                Edit
              </CButton>
              <CButton
                size="sm"
                color="danger"
                class="ml-1"
                @click="(deleteData.id = item.id), (deleteData.modal = true)"
              >
                Delete
              </CButton>
            </td>
          </template>
        </CDataTable>

        <CModal title="Hapus Kompetensi" color="danger" :show.sync="deleteData.modal">
          {{ deleteData.id }} delete Permanent?
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
            <CButton @click="deleteKompetensi">Yes</CButton>
          </template>
        </CModal>
      </CCardBody>
    </CCard>
  </div>
</template>

<script>
import AddModal from "./AddModal.vue";

// data items
const items = [
  {
    no: 1,
    skkpd: "SKKPD 1",
    pengenalan: "Pengenalan 1",
    akomodasi: "Akomodasi 1",
    tindakan: "Tindakan 1",
  },
  {
    no: 2,
    skkpd: "SKKPD 2",
    pengenalan: "Pengenalan 2",
    akomodasi: "Akomodasi 2",
    tindakan: "Tindakan 2",
  },
  {
    no: 3,
    skkpd: "SKKPD 3",
    pengenalan: "Pengenalan 3",
    akomodasi: "Akomodasi 3",
    tindakan: "Tindakan 3",
  },
];

// fields
const fields = [
  { key: "no", _style: "width:1%" },
  { key: "SKKPD" },
  { key: "pengenalan" },
  { key: "akomodasi" },
  { key: "tindakan" },
  {
    key: "actions",
    label: "",
    sorter: false,
    filter: false
  },
];

export default {
  name: "SoalBidangPage",
  components: {
    AddModal,
  },
  data() {
    return {
      items: items.map((item, id) => {
        return { ...item, id };
      }),
      fields,
      details: [],
      collapseDuration: 0,
      deleteData: {
        id: null,
        modal: false,
      },
    };
  },
  methods: {
    deleteKompetensi() {
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