<template>
  <CModal :title="insertModal ? 'Add Butir Angket Konseling' : 'Edit Butir Angket Konseling'" color="primary" size="lg"
    :show.sync="showModal">
    <CRow>
      <CCol sm="12">
        <CTextarea label="Soal" type="text" placeholder="Masukkan Soal" v-model="question" />
      </CCol>
      <CCol sm="12">
        <label> Rumusan Kebutuhan </label>
        <search-input ref="search_input_bidang" :url="'requirements-formulation/search'" v-model="requirement_formulation"
          placeholder="Cari ...">
          <template v-slot="{ data }">
            <span>{{ data.name }}</span>
          </template>
        </search-input>
        <div class="table-responsive no-min-height" v-if="requirement_formulation != null">
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
                <td>{{ requirement_formulation.skkpd.field_component.name }}</td>
                <td>{{ requirement_formulation.skkpd.name }}</td>
                <td>{{ requirement_formulation.name }}</td>
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
    <Loading :loading="loading"></Loading>
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
      loading: false,
      tmp: null,
      id: '',
      question: '',
      requirement_formulation: null,
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
      this.question = ""
      this.requirement_formulation = null
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.question = this.tmp.question
        this.requirement_formulation = this.tmp.requirement_formulation
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat
      if (data != '') {
        console.log(data)
        this.insertModal = false
        this.id = data.id
        this.question = data.question
        this.requirement_formulation = data.requirement_formulation
        this.tmp = data
      } else {
        this.insertModal = true
      }
    },
    async save() {
      this.loading=true
      try {
        let payload = {
          question: this.question,
        }
        if (this.requirement_formulation != null) {
          payload.requirement_formulation_id = this.requirement_formulation.id
        }
        if (this.insertModal) {
          const { data } = await this.axios.post(`survey-items`, payload, {
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
          const { data } = await this.axios.put(`survey-items/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            question: this.question,
            requirement_formulation: this.requirement_formulation,
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
      this.loading=false
    },
  },
}
</script>

<style>

</style>