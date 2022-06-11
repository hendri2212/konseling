<template>
  <CModal :title="insertModal ? 'Add Guru' : 'Edit Guru'" color="primary" :show.sync="showModal">
    <CRow>
      <CCol sm="12">
        <CInput
          label="NIP"
          placeholder="Masukkan NIP"
          v-model="data.nip"
        />
      </CCol>
      <CCol sm="12">
        <CInput
          label="Nama"
          placeholder="Masukkan Nama"
          v-model="data.nama"
        />
      </CCol>
      <CCol sm="12">
        <CInput
          label="Password"
          type="password"
          placeholder="Masukkan Password"
          v-model="data.password"
        />
      </CCol>
      <!-- <CCol sm="12">
        <CInput
          type="number"
          label="Tahun"
          placeholder="Masukkan Tahun"
          v-model="data.year"
        />
      </CCol> -->
    </CRow>

    <template #footer>
      <CButton color="secondary" @click="showModal = false">Close</CButton>
      <CButton color="primary" @click="save">Save</CButton>
    </template>
  </CModal>
</template>

<script>
export default {
  name: "AddModal",
  data() {
    return {
      data: {
        id: null,
        nip: null,
        nama: null,
        password: null,
      },
      insertModal: true,
      showModal: false,
      dataGuru:[]
    };
  },
  computed:{
    guru(){
      return this.dataGuru.map((guru) => {
        return { 
          label: guru.nama,
          id: guru.id
        };
      })
    }
  },
  created(){
    this.axios.get('sekolah/guru', {
      headers: {
        Authorization: "Bearer " + this.$store.state.auth.token
      }
    }).then(response => {
      this.dataGuru = response.data.data
    })
  },
  methods: {
    onSearch(query){
      this.axios.get(`sekolah/guru/search?search=${query}`, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      }).then(response => {
        this.dataGuru = response.data.data
      })
    },
    setModal(stat, data = null) {
      this.showModal = stat;
      if (data != null) {
        this.insertModal = false;
        this.data = data;
      } else {
        this.insertModal = true;
      }
    },
    save() {
      if (this.insertModal) {
        this.axios.post("sekolah/guru", this.data, {
          headers: {
            Authorization: "Bearer " + this.$store.state.auth.token
          }
        }).then(response => {
          this.$swal({
            icon: 'success',
            title: 'Berhasil!',
            text:response.data.message,
          })
        }).catch(e => {
          // var error = ""
          // for (var key in e.response.data.errors) {
          //     error += key + ": " + e.response.data.errors[key] + "<b"
          // }
          this.$swal({
            icon: 'warning',
            title: 'Terjadi Kesalahan',
            text:e.response.data.errors,
          })
        })
      } else {
        console.log("edit");
        console.log(this.data);
      }
    },
  },
};
</script>

<style>
</style>