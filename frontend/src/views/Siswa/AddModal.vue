<template>
  <form @submit.prevent="save">
    <CModal :title="insertModal ? 'Add Siswa' : 'Edit Siswa'" color="primary" :centered="true" :show.sync="showModal">
      <CRow>
        <CCol sm="12">
          <CInput required label="Username" placeholder="Masukkan Username" v-model="username" />
        </CCol>
        <CCol sm="12">
          <CInput :required="insertModal" label="Password" type="password" placeholder="Masukkan Password"
            v-model="password" />
        </CCol>
        <CCol sm="12">
          <CInput required label="Nama" placeholder="Masukkan Nama" v-model="nama" />
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

export default {
  name: "AddModalSiswa",
  components: {
    Loading,
  },
  data() {
    return {
      tmp: null,
      id: '',
      username: '',
      password: '',
      nama: '',
      insertModal: true,
      showModal: false,
      dataSiswa: []
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
      this.id = ''
      this.username = ''
      this.password = ''
      this.nama = ''
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.username = this.tmp.username
        this.nama = this.tmp.nama
      }
    },
    onSearch(query) {
      this.axios.get(`sekolah/siswa/search?search=${query}`, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      }).then(response => {
        this.dataSiswa = response.data.data
      })
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false
        this.id = data.id
        this.username = data.username
        this.nama = data.nama
        this.tmp = data
      } else {
        this.insertModal = true;
      }
    },
    async save() {
      this.$refs.loading.show()
      try {
        if (this.insertModal) {
          let payload = {
            username: this.username,
            nama: this.nama,
          }
          if (this.password != null) {
            payload.password = this.password
          }
          const { data } = await this.axios.post("sekolah/siswa", payload, {
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
          let payload = {
            username: this.username,
            nama: this.nama
          }
          if (this.password != '') {
            payload.password = this.password
          }
          const { data } = await this.axios.put(`sekolah/siswa/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            username: this.username,
            nama: this.nama,
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
};
</script>

<style>

</style>