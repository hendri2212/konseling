<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Identitas Sekolah

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)"
            >Ubah Identitas</CButton
          >
          <!-- <AddModal ref="addModal"></AddModal> -->
        </div>
      </CCardHeader>
      <CCardBody>
        <table style="width:100%" >
          <tr v-for="(item, index) in items" :key="index">
            <th style="width:20%">{{item.head | capitalize}}:</th>
            <td>{{item.body}}</td>
          </tr>
        </table>
      </CCardBody>
    </CCard>
  </div>
</template>

<script>
// const items = [
//         {head: 'pemerintah', body: 'Lorem Ipsum'},
//         {head: 'dinas', body: 'Lorem Ipsum'},
//         {head: 'nama sekolah', body: 'SMK Negeri 1 Kotabaru'},
//         {head: 'alamat', body: 'Lorem Ipsum'},
//         {head: 'nama kepala sekolah', body: 'Lorem Ipsum'},
//     ];

export default {
  name: 'IdentitasSekolah',
  data() {
    return {
      me:null
    };
  },
  computed:{
    items(){
      var items = []
      if(this.me != null){
        items.push(
          {head: 'pemerintah', body:this.me.pemerintah !=null ? this.me.pemerintah : "(Belum diisi)"},
          {head: 'dinas', body: this.me.dinas !=null ?  this.me.dinas : "(Belum diisi)"},
          {head: 'nama sekolah', body: this.me.nama !=null ?  this.me.nama : "(Belum diisi)"},
          {head: 'alamat', body: this.me.alamat_lengkap !=null ?  this.me.alamat_lengkap : "(Belum diisi)"},
          {head: 'nama kepala sekolah', body: this.me.kepsek !=null ?  this.me.kepsek : "(Belum diisi)"},
        )
      }
      return items
    }
  },
  created(){
    this.axios.get('/sekolah/me', {
      headers: {
        Authorization: "Bearer " + this.$store.state.auth.token
      }
    }).then(response => {
      this.me = response.data.data
    })
  },
  filters: {
    capitalize: function (value) {
      if (!value) return ''
      value = value.toString()
      return value.charAt(0).toUpperCase() + value.slice(1)
    }
  }
}
</script>

<style></style>