<template>
  <form @submit.prevent="save">
    <CModal :title="insertModal ? 'Tambah SKKPD' : 'Edit SKKPD'" :centered="true" color="primary" :show.sync="showModal">
      <CRow>
        <CCol sm="12">
          <CInput label="SKKPD" placeholder="Masukkan SKKPD" v-model="nama" />
        </CCol>
        <CCol sm="12">
          <CInput label="Pengenalan" placeholder="Masukkan pengenalan" v-model="pengenalan" />
        </CCol>
        <CCol sm="12">
          <CInput label="Akomodasi" placeholder="Masukkan akomodasi" v-model="akomodasi" />
        </CCol>
        <CCol sm="12">
          <CInput label="Tindakan" placeholder="Masukkan tindakan" v-model="tindakan" />
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
  name: "AddModalSkkpd",
  components: {
    Loading,
  },
  data() {
    return {
      tmp: null,
      id: '',
      nama: '',
      pengenalan: '',
      akomodasi: '',
      tindakan: '',
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
      this.nama = ""
      this.pengenalan = ""
      this.akomodasi = ""
      this.tindakan = ""
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.nama = this.tmp.nama
        this.pengenalan = this.tmp.pengenalan
        this.akomodasi = this.tmp.akomodasi
        this.tindakan = this.tmp.tindakan
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false;
        this.id = data.id
        this.nama = data.nama
        this.pengenalan = data.pengenalan
        this.akomodasi = data.akomodasi
        this.tindakan = data.tindakan
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
            nama: this.nama,
            pengenalan: this.pengenalan,
            akomodasi: this.akomodasi,
            tindakan: this.tindakan,
          }
          const { data } = await this.axios.post(`admin/bidang-layanan/${this.$route.query.bidang_layanan}/skkpd`, payload, {
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
            nama: this.nama,
            pengenalan: this.pengenalan,
            akomodasi: this.akomodasi,
            tindakan: this.tindakan,
          }
          const { data } = await this.axios.put(`admin/bidang-layanan/${this.$route.query.bidang_layanan}/skkpd/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            nama: this.nama,
            pengenalan: this.pengenalan,
            akomodasi: this.akomodasi,
            tindakan: this.tindakan,
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