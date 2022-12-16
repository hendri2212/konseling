<template>
  <form @submit.prevent="save">
    <CModal :title="insertModal ? 'Tambah SKKPD' : 'Edit SKKPD'" :centered="true" color="primary"
      :show.sync="showModal">
      <CRow>
        <CCol sm="12">
          <CInput label="Rumusan Kebutuhan" placeholder="Masukkan rumusan kebutuhan" v-model="nama" />
        </CCol>
        <CCol sm="12">
          <CInput label="Tujuan Layanan" placeholder="Masukkan tujuan layanan" v-model="tujuan_layanan" />
        </CCol>
        <CCol sm="12">
          <label> Materi/Topik </label>
          <search-input ref="search_input_materi" :url="'admin/komponen-layanan/materi'" v-model="materi"
            placeholder="Cari ...">
            <template v-slot="{ data }">
              <span>{{ data.nama }}</span>
            </template>
          </search-input>
          <div class="table-responsive no-min-height" v-if="materi != null">
            <table class="table">
              <thead>
                <tr>
                  <th>Nama</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ materi.nama }}</td>
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
      nama: '',
      tujuan_layanan: '',
      materi: null,
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
      this.tujuan_layanan = ""
      this.materi = null
      if (this.tmp != null) {
        this.id = this.tmp.id
        this.nama = this.tmp.nama
        this.tujuan_layanan = this.tmp.tujuan_layanan
        this.materi = this.tmp.materi
      }
    },
    setModal(stat, data = '') {
      this.showModal = stat;
      if (data != '') {
        this.insertModal = false;
        this.id = data.id
        this.nama = data.nama
        this.tujuan_layanan = data.tujuan_layanan
        this.materi = data.materi
        this.tmp = data
      } else {
        this.insertModal = true;
      }
    },
    async save() {
      this.$refs.loading.show()
      try {
        let payload = {
          nama: this.nama,
          tujuan_layanan: this.tujuan_layanan,
        }
        if (this.materi != null) {
          payload.materi_id = this.materi.id
        }
        if (this.insertModal) {
          const { data } = await this.axios.post(`admin/bidang-layanan/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}/rumusan-kebutuhan`, payload, {
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
          const { data } = await this.axios.put(`admin/bidang-layanan/${this.$route.query.bidang_layanan}/skkpd/${this.$route.query.skkpd}/rumusan-kebutuhan/${this.id}`, payload, {
            headers: {
              Authorization: "Bearer " + this.$store.state.auth.token
            }
          })
          this.tmp = {
            id: this.id,
            nama: this.nama,
            tujuan_layanan: this.tujuan_layanan,
            materi: this.materi,
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