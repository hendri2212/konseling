<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Kelas

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)"
            >Tambah Kelas</CButton
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
          <template #show_details="{ item }">
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

        <CModal title="Delete" color="danger" :show.sync="deleteData.modal">
          Delete Permanent? {{ deleteData.id }}
          <template #footer>
            <CButton color="primary" @click="showModal = false">Close</CButton>
            <CButton @click="deleteKelas">Yes</CButton>
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
    kelas: "10",
    year: "2021",
  },
  {
    no: 2,
    kelas: "11",
    year: "2021",
  },
  {
    no: 3,
    kelas: "12",
    year: "2021",
  },
];

// fields
const fields = [
  { key: "no", _style: "width:1%" },
  { key: "kelas" },
  { key: "year" },
  {
    key: "show_details",
    label: "",
    _style: "width: 20%",
    sorter: false,
    filter: false,
  },
];

export default {
  name: "KelasPage",
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
    deleteKelas() {
      console.log(this.deleteData.id);
      // di sini fungsi axios

      // hapus data di frontend
      this.items.splice(this.deleteData.id, 1);
    },
  },
};
</script>

<style>
</style>