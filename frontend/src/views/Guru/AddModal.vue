<template>
  <CModal :title="insertModal ? 'Add Guru' : 'Edit Guru'" color="primary" :show.sync="showModal">
    <CRow>
      <CCol sm="12">
        <CInput required label="NIP" placeholder="Masukkan NIP" v-model="nip" />
      </CCol>
      <CCol sm="12">
        <CInput required label="Nama" placeholder="Masukkan Nama" v-model="nama" />
      </CCol>
      <CCol sm="12">
        <CInput :required="insertModal" label="Password" type="password" placeholder="Masukkan Password"
          v-model="password" />
      </CCol>
    </CRow>
    <Loading ref="loading"></Loading>
    <template #footer>
      <div class="d-flex justify-content-between w-100">
        <CButton class="text-danger" @click="reset()">Reset</CButton>
        <div>
          <CButton class="mr-2 px-4" color="secondary" @click="showModal = false">Close</CButton>
          <CButton class="px-5" color="primary" @click="save">Save</CButton>
        </div>
      </div>
    </template>
  </CModal>
</template>

<script>
import Loading from '../../components/Loading.vue'
export default {
  name: "AddModal",
  components: {
    Loading,
  },
  data() {
    return {
      id: '',
      nip: '',
      nama: '',
      password: '',
      insertModal: true,
      showModal: false,
      dataGuru: []
    };
  },
  computed: {
    guru() {
      return this.dataGuru.map((guru) => {
        return {
          label: guru.nama,
          id: guru.id
        };
      })
    }
  },
  created() {
    this.$watch(
      () => this.showModal,
      (n) => {
        if (!n && !this.insertModal) {
          this.reset()
        }
      }
    )
  },
  methods: {
    reset() {
      this.id = ""
      this.nip = ""
      this.nama = ""
      this.password = ""
    },
    onSearch(query) {
      this.axios.get(`sekolah/guru/search?search=${query}`, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      }).then(response => {
        this.dataGuru = response.data
      })
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false;
        this.id = data.id
        this.nip = data.nip
        this.nama = data.nama
      } else {
        this.insertModal = true;
      }
    },
    async save() {
      this.$refs.loading.show()
      try {
        if (this.insertModal) {
          const { data } = await this.axios.post("sekolah/guru", this.data, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.reset()
          await this.$swal({
            icon: 'success',
            title: 'Berhasil!',
            text: data.message,
          })
        } else {
          let payload = {}
          payload.nip = this.nip
          payload.nama = this.nama
          if (this.password?.trim().length >= 1) {
            payload.password = this.password
          }
          const { data } = await this.axios.put(`sekolah/guru/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
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
          for (var key in e.response.errors) {
            text += e.response.errors[key] + "<br>"
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