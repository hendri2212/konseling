<template>
  <form @submit.prevent="save">
    <CModal :title="insertModal ? 'Tambah SKKPD' : 'Edit SKKPD'" :centered="true" color="primary" :show.sync="showModal">
      <CRow>
        <CCol sm="12">
          <CInput label="SKKPD" placeholder="Masukkan SKKPD" v-model="name" />
        </CCol>
        <CCol sm="12">
          <CInput label="Pengenalan" placeholder="Masukkan pengenalan" v-model="introduction" />
        </CCol>
        <CCol sm="12">
          <CInput label="Akomodasi" placeholder="Masukkan akomodasi" v-model="accommodation" />
        </CCol>
        <CCol sm="12">
          <CInput label="Tindakan" placeholder="Masukkan tindakan" v-model="action" />
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
import Loading from '@/components/Loading.vue'

export default {
  name: "AddModalSkkpd",
  components: {
    Loading,
  },
  data() {
    return {
      loading: false,
      tmp: null,
      id: '',
      name: '',
      introduction: '',
      accommodation: '',
      action: '',
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
      this.introduction = ""
      this.accommodation = ""
      this.action = ""
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.name = this.tmp.name
        this.introduction = this.tmp.introduction
        this.accommodation = this.tmp.accommodation
        this.action = this.tmp.action
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false;
        this.id = data.id
        this.name = data.name
        this.introduction = data.introduction
        this.accommodation = data.accommodation
        this.action = data.action
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
            name: this.name,
            introduction: this.introduction,
            accommodation: this.accommodation,
            action: this.action,
          }
          const { data } = await this.axios.post(`field-components/${this.$route.query.bidang_layanan}/skkpd`, payload, {
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
            name: this.name,
            introduction: this.introduction,
            accommodation: this.accommodation,
            action: this.action,
          }
          const { data } = await this.axios.put(`field-components/${this.$route.query.bidang_layanan}/skkpd/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            name: this.name,
            introduction: this.introduction,
            accommodation: this.accommodation,
            action: this.action,
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