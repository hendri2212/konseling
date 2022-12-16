<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        <h1>Rumusan Kebutuhan dari SKKPD "{{skkpd.nama}}"</h1>

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Rumusan Kebutuhan</CButton>
          <AddModal @saved="saved" ref="addModal"></AddModal>
        </div>
      </CCardHeader>
      <CCardBody>
        <CDataTable :responsive="true" v-if="datatable" :items="items" :fields="fields" hover>
          <template #materi="{ item }">
          <td align="left">
            <span v-if="(item.materi != null)">
              {{item.materi.nama}}
            </span>
            <span v-else class="text-danger">
              Belum ada
            </span>
          </td>
        </template>
          <template #actions="{ item, index }">
            <td align="right">
              <CDropdown color="none" toggler-text="Dropdown Button" class="m-2">
                <template #toggler-content>
                  <CIcon name="cil-cog" />
                </template>
                <CDropdownItem @click="$refs.addModal.setModal(true, item)">
                  <CIcon name="cil-cog" class="mr-1" />
                  Edit
                </CDropdownItem>
                <CDropdownItem
                  @click="(deleteData.index = index), (deleteData.nama = item.nama), (deleteData.modal = true)">
                  <CIcon name="cil-trash" class="mr-1" />
                  Delete
                </CDropdownItem>
              </CDropdown>
            </td>
          </template>
          <template #under-table>
            <CPagination :activePage.sync="pagination.active" :pages="pagination.max_page" align="center" />
          </template>
        </CDataTable>

        <CModal title="Hapus Skkpd" color="danger" :show.sync="deleteData.modal">
          <span>Hapus SKKPD {{ deleteData.nama }} ?</span>
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
            <CButton @click="remove">Yes</CButton>
          </template>
        </CModal>
      </CCardBody>
    </CCard>
    <Loading ref="loading"></Loading>
  </div>
</template>

<script>
import AddModal from './AddModal.vue'
import Loading from '@/components/Loading.vue'

// fields
const fields = [
  { label: 'Rumusan Kebutuhan', key: "nama" },
  { label: 'Tujuan Layanan', key: "tujuan_layanan" },
  { label: 'Materi/Topik', key: "materi"},
  // { label: 'Jumlah Materi/Topik', key: "nama" },
  { label: "", key: "actions" },
];

export default {
  name: "SkkpdPage",
  components: {
    AddModal,
    Loading,
  },
  data() {
    return {
      datatable: true,
      pagination: {
        max_page: 1,
        active: 1,
      },
      skkpd: {
        nama: '',
      },
      fields,
      items: [],
      deleteData: {
        index: -1,
        nama: '',
        modal: false,
      },
    };
  },
  async mounted() {
    this.getData()
  },
  methods: {
    async getData() {
      await this.$refs.loading.show()
      try {
        await this.getSkkpd()
        await this.getRumusanKebutuhan()
      } catch (e) {
        console.log(e)
      } finally {
        await this.$refs.loading.hide()
      }
    },
    async getSkkpd() {
      const { data: skkpd } = await this.axios.get(`admin/bidang-layanan/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}`, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      })
      this.skkpd.nama = skkpd.data.nama
    },
    async getRumusanKebutuhan() {
      const { data } = await this.axios.get(`admin/bidang-layanan/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}/rumusan-kebutuhan`, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      })
      this.items = data.data
      this.pagination.max_page = data.pagination.max_page
    },
    async forceRerender() {
      this.datatable = false;
      await this.$nextTick();
      this.datatable = true;
    },
    async saved() {
      await this.getData()
      await this.forceRerender()
    },
    async remove() {
      if (this.deleteData.index == -1 || !this.items[this.deleteData.index]) {
        this.deleteData.modal = false
        return;
      }
      try {
        this.$refs.loading.show()
        // di sini fungsi axios
        const { data } = await this.axios.delete(`admin/bidang-layanan/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}/rumusan-kebutuhan/${this.items[this.deleteData.index].id}`, {
          headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
          }
        })
        this.$refs.loading.hide()
        await this.$swal({
          icon: 'success',
          title: 'Berhasil!',
          text: data.message,
        })
      } catch (e) {
        this.$refs.loading.hide()
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
        this.getData()
      }
    },
  },
};
</script>

<style>

</style>