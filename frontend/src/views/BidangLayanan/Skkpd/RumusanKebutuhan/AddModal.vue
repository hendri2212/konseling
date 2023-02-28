<template>
  <form @submit.prevent="save">
    <CModal :title="insertModal ? 'Tambah SKKPD' : 'Edit SKKPD'" :centered="true" color="primary"
      :show.sync="showModal">
      <CRow>
        <CCol sm="12">
          <CInput label="Rumusan Kebutuhan" placeholder="Masukkan rumusan kebutuhan" v-model="name" />
        </CCol>
        <CCol sm="12">
          <CInput label="Tujuan Layanan" placeholder="Masukkan tujuan layanan" v-model="service_objective" />
        </CCol>
        <CCol sm="12">
          <label> Materi/Topik </label>
          <search-input ref="search_input_materi" :url="'topics'" v-model="topic"
            placeholder="Cari ...">
            <template v-slot="{ data }">
              <span>{{ data.name }}</span>
            </template>
          </search-input>
          <div class="table-responsive no-min-height" v-if="topic != null">
            <table class="table">
              <thead>
                <tr>
                  <th>name</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ topic.name }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <p class="text-danger text-center mt-2" v-else>
            Belum ada materi/topik yang dipilih
          </p>
        </CCol>
      </CRow>

      <template #footer>
        <div class="d-flex justify-content-between w-100">
          <CButton class="text-danger" @click="reset()">Reset</CButton>
          <div>
            <CButton class="mr-2 px-4" color="secondary" @click="showModal = false">Close</CButton>
            <CButton type="submit" class="px-5" color="primary">Save</CButton>
          </div>
        </div>
      </template>

      <Loading ref="loading"></Loading>
    </CModal>
  </form>
</template>

<script>
import Loading from '@/components/Loading.vue'
import SearchInput from '@/components/SearchInput.vue';

export default {
  name: "AddModalSkkpd",
  components: {
    Loading,
    SearchInput,
  },
  data() {
    return {
      tmp: null,
      id: '',
      name: '',
      service_objective: '',
      topic: null,
      insertModal: true,
      showModal: false,
    };
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
      this.name = ""
      this.service_objective = ""
      this.topic = null
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.name = this.tmp.name
        this.service_objective = this.tmp.service_objective
        this.topic = this.tmp.topic
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false;
        this.id = data.id
        this.name = data.name
        this.service_objective = data.service_objective
        this.topic = data.topic
        this.tmp = data
      } else {
        this.insertModal = true;
      }
    },
    async save() {
      this.loading = true
      try {
        let payload = {
          name: this.name,
          service_objective: this.service_objective,
        }
        if (this.topic != null) {
          payload.topic_id = this.topic.id
        }
        if (this.insertModal) {
          const { data } = await this.axios.post(`field-components/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}/requirements-formulation`, payload, {
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
          const { data } = await this.axios.put(`field-components/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}/requirements-formulation/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            name: this.name,
            service_objective: this.service_objective,
            topic: this.topic,
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
      this.loading = false
    },
  },
};
</script>