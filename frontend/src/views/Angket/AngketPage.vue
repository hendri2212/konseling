<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Angket

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Angket</CButton>
          <AddModal @saved="saved" ref="addModal"></AddModal>
        </div>
      </CCardHeader>

      <CCardBody>
        <CDataTable :responsive="true" v-if="datatable" :items="items" :fields="fields" hover>
          <template #kelas="{ item }">
            <td>{{ item.kelas.nama }}</td>
          </template>
          <template #status="{ item }">
            <td>
              <CBadge :color="item.status == 'close' ? 'danger' : 'success'">
                {{ item.status }}
              </CBadge>
            </td>
          </template>
          <template #actions="{ item, index }">
            <td align="right">
              <CDropdown color="none" toggler-text="Dropdown Button" class="m-2">
                <template #toggler-content>
                  <CIcon name="cil-cog" />
                </template>
                <CDropdownItem @click="bukaAngket(item.id)" v-if="item.status == 'close'" class="text-success">
                  <CIcon name="cil-cog" class="mr-1" />
                  Open
                </CDropdownItem>
                <CDropdownItem @click="tutupAngket(item.id)" v-else class="text-danger">
                  <CIcon name="cil-cog" class="mr-1" />
                  Close
                </CDropdownItem>
                <!-- <CDropdownItem @click="$refs.addModal.setModal(true, item)">
                  <CIcon name="cil-cog" class="mr-1" />
                  Edit
                </CDropdownItem> -->
                <CDropdownItem
                  @click="(deleteData.index = index), (deleteData.nama = item.nama), (deleteData.modal = true)">
                  <CIcon name="cil-trash" class="mr-1" />
                  Delete
                </CDropdownItem>
              </CDropdown>
            </td>
          </template>
          <template #under-table>
            <CPagination :activePage.sync="pagination.active" @update:activePage="getData" :pages="pagination.max_page"
              align="center" />
          </template>
        </CDataTable>

        <CModal title="Hapus Angket" color="danger" :show.sync="deleteData.modal">
          <span>Hapus angket {{ deleteData.nama }} ?</span>
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Batal</CButton>
            <CButton @click="remove">Oke</CButton>
          </template>
        </CModal>
      </CCardBody>
    </CCard>
    <Loading ref="loading"></Loading>
  </div>
</template>

<script>
import AddModal from './AddModal.vue';
import Loading from '@/components/Loading.vue'

// fields
const fields = [
  { label: 'Angket', key: 'nama' },
  { label: 'Kelas', key: 'kelas' },
  { label: 'Tanggal Angket', key: 'tanggal' },
  { label: 'Status', key: 'status' },
  { label: '', key: 'actions' }
]

export default {
  name: 'AngketPage',
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
      items: [],
      fields,
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
    async getData(param = null) {
      let page = param ?? 1;
      this.$refs.loading.show()
      try {
        const { data } = await this.axios.get(`guru/angket?page=${page}`, {
          headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
          }
        })
        this.items = data.data
        this.pagination.max_page = data.pagination.max_page
      } catch (e) {
        console.log(e)
      } finally {
        this.$refs.loading.hide()
      }
    },
    async forceRerender() {
      this.datatable = false;
      await this.$nextTick();
      this.datatable = true;
    },
    async saved() {
      await this.getData(this.pagination.active)
      await this.forceRerender()
    },
    async remove() {
      if (this.deleteData.index == -1 || !this.items[this.deleteData.index]) {
        this.deleteData.modal = false
        return;
      }
      try {
        // di sini fungsi axios
        const { data } = await this.axios.delete(`guru/angket/${this.items[this.deleteData.index].id}`, {
          headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
          }
        })
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
        this.getData(this.pagination.active)
      }
    },
    bukaAngket(id) {
      this.axios.patch(`guru/angket/${id}/open`, {}, {
        headers: {
          Authorization: 'Bearer ' + this.$store.state.auth.token
        }
      }).then(response => {
        let index = this.items.findIndex(p => p.id == id)
        this.items[index].status = 'open'
        this.$swal({
          icon: 'success',
          title: 'Berhasil!',
          text: response.data.data.data,
        })
      }).catch(e => {
        let status = e.response.status
        let data = e.response.data.errors
        if (status == 422) {
          this.$swal({
            icon: 'warning',
            title: 'Gagal!',
            text: data,
          })
        } else {
          this.$swal({
            icon: 'error',
            title: 'Gagal!',
            text: data,
          })
        }
      })
    },
    tutupAngket(id) {
      this.axios.patch(`guru/angket/${id}/close`, {}, {
        headers: {
          Authorization: 'Bearer ' + this.$store.state.auth.token
        }
      }).then(response => {
        let index = this.items.findIndex(p => p.id == id)
        this.items[index].status = 'close'
        this.$swal({
          icon: 'success',
          title: 'Berhasil!',
          text: response.data.data.data,
        })
      }).catch(e => {
        let data = e.response.data.errors
        this.$swal({
          icon: 'error',
          title: 'Gagal!',
          text: data,
        })
      })
    },
  },
};
</script>

<style>

</style>