<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Guru

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Guru</CButton>
          <AddModal ref="addModal"></AddModal>
        </div>
      </CCardHeader>

      <CCardBody>
        <CDataTable :items="items" :fields="fields" column-filter table-filter items-per-page-select :items-per-page="5"
          hover sorter pagination>
          <template #show_details="{ item, index }">
            <td class="py-2">
              <CButton size="sm" color="info" @click="$refs.addModal.setModal(true, item)">
                Edit
              </CButton>
              <CButton size="sm" color="danger" class="ml-1"
                @click="(deleteData.index = index), (deleteData.modal = true)">
                Delete
              </CButton>
            </td>
          </template>
        </CDataTable>

        <CModal title="Hapus Guru" color="danger" :show.sync="deleteData.modal">
          <span v-if="deleteData.index != -1">Delete akun guru yang bernama {{ items[deleteData.index].nama }} ?</span>
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
            <CButton @click="deleteGuru">Yes</CButton>
          </template>
        </CModal>
      </CCardBody>
    </CCard>
    <Loading ref="loading"></Loading>
  </div>
</template>

<script>
import AddModal from "./AddModal.vue"
import Loading from '../../components/Loading.vue'

// fields
const fields = [
  { key: "nip", label: 'NIP' },
  { key: "nama", label: 'Nama' },
  { key: "nama", label: 'Status' },
  {
    key: "show_details",
    label: "Action",
    _style: "width: 20%",
    sorter: false,
    filter: false,
  },
];

export default {
  name: "GuruPage",
  components: {
    AddModal,
    Loading,
  },
  data() {
    return {
      items: [],
      fields,
      details: [],
      collapseDuration: 0,
      deleteData: {
        index: -1,
        modal: false,
      },
    };
  },
  async mounted() {
    this.$refs.loading.show()
    try {
      const { data } = await this.axios.get('sekolah/guru', {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      })
      this.items = data.data
    } catch (e) {
      console.log(e)
    } finally {
      this.$refs.loading.hide()
    }
  },
  methods: {
    async deleteGuru() {
      if (this.deleteData.index == -1 || !this.items[this.deleteData.index]) {
        this.deleteData.modal = false
        return;
      }
      this.$refs.loading.show()
      try {
        // di sini fungsi axios
        const { data } = await this.axios.delete(`sekolah/guru/${this.items[this.deleteData.index].id}`, {
          headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
          }
        })
        // hapus data di frontend
        this.items.splice(this.deleteData.index, 1);

        await this.$swal({
          icon: 'success',
          title: 'Berhasil!',
          text: data.message,
        })
      } catch (e) {
        var icon = 'error'
        var title = 'Terjadi Kesalahan'
        var text = 'Terjadi Kesalahan di aplikasi'
        if (e.response.status == 422) {
          text = ''
          icon = 'warning'
          for (var key in e.response.errors) {
            text += e.response.errors[key] + "<br>"
          }
        }
        await this.$swal({
          icon: icon,
          title: title,
          html: text,
        })
      } finally {
        this.deleteData.index = -1
        this.deleteData.modal = false
        this.$refs.loading.hide()
      }
    },
  },
};
</script>

<style>

</style>