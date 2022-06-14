<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Ujian

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)"
            >Tambah Ujian</CButton
          >
          <AddModal ref="addModal"></AddModal>
        </div>
      </CCardHeader>

      <CCardBody>
        <CDataTable
          :items="items_table"
          :fields="fields"
          column-filter
          table-filter
          items-per-page-select
          :items-per-page="5"
          hover
          sorter
          pagination
        >
          <template #status="{item}">
            <td>
              <CBadge :color="item.status == 'close' ? 'danger' : 'success'">
                {{item.status}}
              </CBadge>
            </td>
          </template>
          <template #show_details="{ item }">
            <td class="py-2">
              <CButton
                size="sm"
                color="success"
                @click="bukaUjian(item.id)"
                v-if="item.status == 'close'"
              >
                Buka Ujian
              </CButton>
              <CButton
                size="sm"
                color="danger"
                 @click="tutupUjian(item.id)"
                v-else
              >
                Tutup Ujian
              </CButton>
              <CButton
                size="sm"
                color="info"
                class="ml-1"
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

        <CModal title="Hapus Kelas" color="danger" :show.sync="deleteData.modal">
          {{ deleteData.id }} delete Permanent?
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
            <CButton @click="deleteUjian">Yes</CButton>
          </template>
        </CModal>
      </CCardBody>
    </CCard>
  </div>
</template>

<script>
import AddModal from "./AddModal.vue";


// fields
const fields = [
  { key: "no", _style: "width:1%" },
  { label:'Ujian', key: "nama" },
  { label:'Kelas', key: "kelas" },
  { label:'Tanggal Ujian', key: "tanggal" },
  { 
    label:'Status', 
    key: "status",
  },
  {
    key: "show_details",
    label: "",
    _style: "width: 20%",
    sorter: false,
    filter: false,
  },
]

export default {
  name: "UjianPage",
  components: {
    AddModal,
  },
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
  computed:{
    items_table(){
      return this.items.map((p, index) => {
        return {
          id:p.id,
          no:index+1,
          nama: p.nama,
          kelas: p.kelas.nama,
          tanggal: p.tanggal,
          status: p.status,
        }
      })
    }
  },
  created(){
    this.axios.get('guru/ujian', {
      headers: {
        Authorization: "Bearer " + this.$store.state.auth.token
      }
    }).then(response => {
      this.items = response.data.data
    })
  },
  methods: {
    deleteUjian() {
      console.log(this.deleteData.id);
      // di sini fungsi axios

      // hapus data di frontend
      this.items.splice(this.deleteData.id, 1);

      this.deleteData.modal = false;
    },
    bukaUjian(id){
      this.axios.patch(`guru/ujian/${id}/open`, {}, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      }).then(response => {
        let index= this.items.findIndex(p => p.id == id)
        this.items[index].status = 'open'
        this.$swal({
          icon: 'success',
          title: 'Berhasil!',
          text:response.data.data.data,
        })
      }).catch(e => {
        let status = e.response.status
        let data = e.response.data.errors
        if(status == 422){
          this.$swal({
            icon: 'warning',
            title: 'Gagal!',
            text:data,
          })
        }else{
          this.$swal({
            icon: 'error',
            title: 'Gagal!',
            text:data,
          })
        }
      })
    },
    tutupUjian(id){
      this.axios.patch(`guru/ujian/${id}/close`, {}, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      }).then(response => {
        let index= this.items.findIndex(p => p.id == id)
        this.items[index].status = 'close'
        this.$swal({
          icon: 'success',
          title: 'Berhasil!',
          text:response.data.data.data,
        })
      }).catch(e => {
        let data = e.response.data.errors
        this.$swal({
            icon: 'error',
            title: 'Gagal!',
            text:data,
          })
      })
    },
  },
};
</script>

<style>
</style>