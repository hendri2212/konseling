<template>
  <form @submit.prevent="save">
    <CModal :title="insertModal ? 'Add Guru' : 'Edit Guru'" color="primary" :centered="true" :show.sync="showModal">
      <CRow>
        <CCol sm="12">
          <CInput required label="Email" placeholder="Masukkan Email" v-model="email" />
        </CCol>
        <CCol sm="12">
          <CInput required label="Nama" placeholder="Masukkan Nama" v-model="name" />
        </CCol>
        <CCol sm="12">
          <CInput :required="insertModal" label="Password" type="password" placeholder="Masukkan Password"
            v-model="password" />
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
      <Loading :loading="loading"></Loading>
    </CModal>
  </form>
</template>

<script>
import Loading from '../../components/Loading.vue'
export default {
  name: "AddModalGuru",
  components: {
    Loading,
  },
  emits: ['saved'],
  data() {
    return {
      loading: false,
      tmp: null,
      id: '',
      email: '',
      name: '',
      password: '',
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
      this.email = ""
      this.name = ""
      this.password = ""
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.email = this.tmp.email
        this.name = this.tmp.name
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false;
        this.id = data.id
        this.email = data.email
        this.name = data.name
        this.tmp = data
      } else {
        this.insertModal = true;
      }
    },
    async save() {
      this.loading = true
      try {
        if (this.insertModal) {
          let payload = {
            email: this.email,
            name: this.name,
            password: this.password,
          }
          const { data } = await this.axios.post("teachers", payload, {
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
          let payload = {}
          payload.email = this.email
          payload.name = this.name
          if (this.password?.trim().length >= 1) {
            payload.password = this.password
          }
          const { data } = await this.axios.put(`teachers/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            email: this.email,
            name: this.name,
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