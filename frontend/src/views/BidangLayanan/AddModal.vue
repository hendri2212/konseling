<template>
  <form @submit.prevent="save">
    <CModal :title="insertModal ? 'Tambah Bidang Layanan' : 'Edit Bidang Layanan'" color="primary" :centered="true" :show.sync="showModal">
      <CRow>
        <CCol sm="12">
          <CInput label="Nama Bidang Layanan" placeholder="Masukkan bidang layanan" v-model="name" />
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
  name: "AddModalKelas",
  components: {
    Loading,
  },
  data() {
    return {
      loading: false,
      tmp: null,
      id: '',
      name: '',
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
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.name = this.tmp.name
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false;
        this.id = data.id
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
            name: this.name,
          }
          const { data } = await this.axios.post("field-components", payload, {
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
            name: this.name
          }
          const { data } = await this.axios.put(`field-components/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            name: this.name
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