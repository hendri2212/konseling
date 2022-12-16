<template>
  <CModal :title="insertModal ? 'Add Butir Angket Konseling' : 'Edit Butir Angket Konseling'" color="primary" size="lg"
    :show.sync="showModal">
    <CRow>
      <CCol sm="12">
        <CTextarea label="Soal" type="text" placeholder="Masukkan Soal" v-model="soal" />
      </CCol>
      <CCol sm="12">
        <label> Rumusan Kebutuhan </label>
        <search-input ref="search_input_bidang" :url="'admin/rumusan-kebutuhan/search'" v-model="rumusan_kebutuhan"
          placeholder="Cari ...">
          <template v-slot="{ data }">
            <span>{{ data.nama }}</span>
          </template>
        </search-input>
        <div class="table-responsive no-min-height" v-if="rumusan_kebutuhan != null">
          <table class="table">
            <thead>
              <tr>
                <th>Bidang</th>
                <th>SKKPD</th>
                <th>Rumusan Kebutuhan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ rumusan_kebutuhan.skkpd.bidang.nama }}</td>
                <td>{{ rumusan_kebutuhan.skkpd.nama }}</td>
                <td>{{ rumusan_kebutuhan.nama }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="text-danger text-center mt-2" v-else>
          Belum ada bidang yang dipilih
        </p>
      </CCol>
    </CRow>

    <template #footer>
      <CButton color="secondary" @click="showModal = false">Close</CButton>
      <CButton color="primary" @click="save">Save</CButton>
    </template>
    <Loading ref="loading"></Loading>
  </CModal>
</template>

<script>
import Loading from '@/components/Loading.vue'
import SearchInput from '@/components/SearchInput.vue'
export default {
  name: 'SoalModal',
  components: {
    Loading,
    SearchInput,
  },
  data() {
    return {
      tmp: null,
      id: '',
      soal: '',
      rumusan_kebutuhan: null,
      insertModal: true,
      showModal: false,
    }
  },
  created() {
    this.$watch(
      () => this.showModal,
      (n) => {
        if (!n && !this.insertModal) {
          this.tmp = null
          this.reset()
        }
      }
    )
  },
  methods: {
    reset() {
      this.id = ""
      this.soal = ""
      this.rumusan_kebutuhan = null
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.soal = this.tmp.soal
        this.rumusan_kebutuhan = this.tmp.rumusan_kebutuhan
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat
      if (data != '') {
        this.insertModal = false
        this.id = data.id
        this.soal = data.soal
        this.rumusan_kebutuhan = data.rumusan_kebutuhan
        this.tmp = data
      } else {
        this.insertModal = true
      }
    },
    async save() {
      this.$refs.loading.show()
      try {
        let payload = {
          soal: this.soal,
        }
        if (this.rumusan_kebutuhan != null) {
          payload.rumusan_kebutuhan_id = this.rumusan_kebutuhan.id
        }
        if (this.insertModal) {
          const { data } = await this.axios.post(`admin/butir-angket-konseling`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.reset()
          this.$emit('saved')
          await this.$swal({
            icon: 'success',
            title: 'Berhasil!',
            text: data.message,
          })
        } else {
          const { data } = await this.axios.put(`admin/butir-angket-konseling/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            soal: this.soal,
            rumusan_kebutuhan: this.rumusan_kebutuhan,
          }
          this.$emit('saved')
          await this.$swal({
            icon: 'success',
            title: 'Berhasil!',
            text: data.message,
          })
        }
      } catch (e) {
        var icon = 'error'
        var title = 'Terjadi Kesalahan'
        var text = 'Terjadi Kesalahan di aplikasi'
        if (e.response.status == 422) {
          text = ''
          icon = 'warning'
          for (var key in e.response.data.errors) {
            text += e.response.data.errors[key] + "<br>"
          }
        }
        await this.$swal({
          icon: icon,
          title: title,
          html: text,
        })
      }
      this.$refs.loading.hide()
    },
  },
}
</script>

<style>

</style>