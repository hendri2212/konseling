<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Soal AKPD

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Soal</CButton>

          <AddModal @saved="saved" ref="addModal"></AddModal>
        </div>
      </CCardHeader>

      <CCardBody>
        <CDataTable :responsive="true" v-if="datatable" :items="items" :fields="fields" hover>
          <template #field_component="{ item }">
            <td align="left" v-if="(item.requirement_formulation?.skkpd?.field_component != null)">
              {{item.requirement_formulation.skkpd.field_component.name}}
            </td>
            <td v-else class="text-danger">
              Belum ada
            </td>
          </template>
          <template #skkpd="{ item }">
            <td align="left" v-if="(item.requirement_formulation?.skkpd != null)">
              {{item.requirement_formulation.skkpd.name}}
            </td>
            <td v-else class="text-danger">
              Belum ada
            </td>
          </template>
          <template #requirement_formulation="{ item }">
            <td align="left" v-if="(item.requirement_formulation != null)">
              {{item.requirement_formulation.name}}
            </td>
            <td v-else class="text-danger">
              Belum ada
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
                  @click="(deleteData.index = index), (deleteData.question = item.question), (deleteData.modal = true)">
                  <CIcon name="cil-trash" class="mr-1" />
                  Delete
                </CDropdownItem>
              </CDropdown>
            </td>
          </template>
          <template #under-table>
            <CPagination :activePage.sync="pagination.active" @update:activePage="getData" :pages="pagination.max_page" align="center" />
          </template>
        </CDataTable>

        <CModal title="Hapus Butir Angket" color="danger" :show.sync="deleteData.modal">
          <span>Hapus butir angket {{ deleteData.question }} ?</span>
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Batal</CButton>
            <CButton @click="remove">Oke</CButton>
          </template>
        </CModal>
      </CCardBody>
    </CCard>
    <Loading :loading="loading"></Loading>
  </div>
</template>

<script>
import AddModal from "./AddModal.vue";
import Loading from '@/components/Loading.vue'
import axios from 'axios'

// fields
const fields = [
  { label: "Soal", key: "question"},
  { label: "Bidang Layanan", key: "field_component" },
  { label: "SKKPD", key: "skkpd" },
  { label: "Rumusan Kebutuhan", key: "requirement_formulation" },
  { label: "", key: "actions" },
]

export default {
  name: 'SoalPage',
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
      items: [],
      fields,
      deleteData: {
        index: -1,
        question: '',
        modal: false,
      },
    }
  },
  async mounted() {
    this.getData()
  },
  methods: {
    async getData(param = null) {
      let page = param ?? 1
      this.loading=true
      try {
        const { data } = await axios.get(`survey-items?page=${page}`, {
          headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
          }
        })
        this.items = data.data
        this.pagination.max_page = data.pagination.max_page
      } catch (e) {
        console.log(e)
      } finally {
        this.loading=false
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
        this.loading=true
        // di sini fungsi axios
        const { data } = await this.axios.delete(`butir-angket-konseling/${this.items[this.deleteData.index].id}`, {
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
        this.loading = false
        this.getData(this.pagination.active)
      }
    },
  },
}
</script>

<style>

</style>