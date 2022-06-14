<template>
  <CModal title="Add Edit Kelas" color="primary" :show.sync="showModal">
    <CRow>
      <CCol sm="12">
        <CInput
          label="Kelas"
          placeholder="Masukkan Kelas"
          v-model="data.kelas"
        />
      </CCol>
      <CCol sm="12">
        <div role="group" class="form-group">
          <label for="uid-vcqehbyou6" class=""> Guru </label>
          <v-select 
          :options="guru"
          @search="onSearch">
          </v-select>
        </div>
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
        kelas: null,
        guru_id: null,
        year: null,
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
        this.data.id = null;
        this.data.kelas = null;
        this.data.year = null;
      }
    },
    save() {
      if (this.insertModal) {
        this.axios.post("sekolah/kelas", {
          nama: this.data.kelas
        }, {
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
          console.log(e)
          // this.$swal({
          //   icon: 'warning',
          //   title: 'Terjadi Kesalahan',
          //   text:e.response.data.message,
          // })
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