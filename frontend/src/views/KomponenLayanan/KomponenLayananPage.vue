<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Komponen Layanan

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Komponen Layanan</CButton>
          <AddModal @saved="saved" ref="addModal"></AddModal>
        </div>
      </CCardHeader>

      <CCardBody>
        <CDataTable :responsive="false" v-if="datatable" :items="items" :fields="fields" hover>
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
                <CDropdownItem @click="$router.push({ name: 'Materi', query: { komponen_layanan: item.id } })">
                  <CIcon name="cil-group" class="mr-1" />
                  Materi/Topik
                </CDropdownItem>
              </CDropdown>
            </td>
          </template>
        </CDataTable>

        <CModal title="Hapus Kelas" color="danger" :show.sync="deleteData.modal">
          <span>Delete komponen layanan {{ deleteData.nama }} ?</span>
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
import Loading from '../../components/Loading.vue'

// fields
const fields = [
  { label: 'Komponen Layanan', key: "nama" },
  // { label: 'Jumlah Materi/Topik', key: "nama" },
  { label: "", key: "actions" },
];

export default {
  name: "KomponenLayananPage",
  components: {
    AddModal,
    Loading,
  },
  data() {
    return {
      datatable: true,
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
    async getData() {
      this.$refs.loading.show()
      try {
        const { data } = await this.axios.get('admin/komponen-layanan', {
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
        const { data } = await this.axios.delete(`admin/komponen-layanan/${this.items[this.deleteData.index].id}`, {
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