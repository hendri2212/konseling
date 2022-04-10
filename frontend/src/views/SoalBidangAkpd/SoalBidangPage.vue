<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Bidang Soal AKPD

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)"
            >Tambah Bidang</CButton
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

        <CModal title="Hapus Bidang" color="danger" :show.sync="deleteData.modal">
          {{ deleteData.id }} delete Permanent?
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
            <CButton @click="deleteBidang">Yes</CButton>
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
    nama_bidang: "bidang 1",
  },
  {
    no: 2,
    nama_bidang: "bidang 2",
  },
  {
    no: 3,
    nama_bidang: "bidang 3",
  },
];

// fields
const fields = [
  { key: "no", _style: "width:1%" },
  { key: "nama_bidang" },
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
    deleteBidang() {
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