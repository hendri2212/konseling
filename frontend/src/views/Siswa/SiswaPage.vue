<template>
    <div>
      <CCard accent-color="primary">
        <CCardHeader>
          Data Peserta Didik
  
          <div class="card-header-actions">
            <!-- <CButton color="primary" @click="$refs.addModal.setModal(true)"
              >Tambah Kelas</CButton
            > -->
            <!-- <AddModal ref="addModal"></AddModal> -->
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
  
          <!-- <CModal title="Hapus Kelas" color="danger" :show.sync="deleteData.modal">
            {{ deleteData.id }} delete Permanent?
            <template #footer>
              <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
              <CButton @click="deleteKelas">Yes</CButton>
            </template>
          </CModal> -->
        </CCardBody>
      </CCard>
    </div>
  </template>
  
  <script>
//   import AddModal from "./AddModal.vue";
  
  
//   fields
  const fields = [
    { label : 'No', key : "id", _style: "width:1%" },
    { label : 'Nisn', key : "nisn" },
    { label : 'Kelas', key : "nama" },
    { label : 'Email', key : "email" },
    { label : 'Tahun', key : "tahun_masuk" },
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
    // components: {
    //   AddModal,
    // },
    data() {
      return {
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
    created(){
      this.axios.get('siswa/peserta', {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      }).then(response => {
        this.items = response.data
      })
    },
    methods: {
      deleteKelas() {
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