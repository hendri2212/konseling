<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        <h1>Rumusan Kebutuhan dari SKKPD "{{skkpd.name}}"</h1>

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Rumusan Kebutuhan</CButton>
          <AddModal @saved="saved" ref="addModal"></AddModal>
        </div>
      </CCardHeader>
      <CCardBody>
        <CDataTable :responsive="true" v-if="datatable" :items="items" :fields="fields" hover>
          <template #topic="{ item }">
          <td align="left">
            <span v-if="(item.topic != null)">
              {{item.topic.name}}
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
                  @click="(deleteData.index = index), (deleteData.name = item.name), (deleteData.modal = true)">
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
          <span>Hapus SKKPD {{ deleteData.name }} ?</span>
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
            <CButton @click="remove">Yes</CButton>
          </template>
        </CModal>
      </CCardBody>
    </CCard>
    <Loading :loading="loading"></Loading>
  </div>
</template>

<script>
import AddModal from './AddModal.vue'
import Loading from '@/components/Loading.vue'

// fields
const fields = [
  { label: 'Rumusan Kebutuhan', key: "name" },
  { label: 'Tujuan Layanan', key: "service_objective" },
  { label: 'Materi/Topik', key: "topic"},
  // { label: 'Jumlah Materi/Topik', key: "name" },
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
      loading: true,
      datatable: true,
      pagination: {
        max_page: 1,
        active: 1,
      },
      skkpd: {
        name: '',
      },
      fields,
      items: [],
      deleteData: {
        index: -1,
        name: '',
        modal: false,
      },
    };
  },
  async mounted() {
    this.getData()
  },
  methods: {
    async getData() {
      this.loading = true
      try {
        await this.getSkkpd()
        await this.getRumusanKebutuhan()
      } catch (e) {
        console.log(e)
      } finally {
        this.loading = false
      }
    },
    async getSkkpd() {
      const { data: skkpd } = await this.axios.get(`field-components/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}`, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      })
      this.skkpd.name = skkpd.data.name
    },
    async getRumusanKebutuhan() {
      const { data } = await this.axios.get(`field-components/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}/requirements-formulation`, {
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
        this.loading = true
        // di sini fungsi axios
        const { data } = await this.axios.delete(`field-components/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}/requirements-formulation/${this.items[this.deleteData.index].id}`, {
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
        this.loading = false
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