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
const items = [
        {head: 'pemerintah', body: 'Lorem Ipsum'},
        {head: 'dinas', body: 'Lorem Ipsum'},
        {head: 'nama sekolah', body: 'SMK Negeri 1 Kotabaru'},
        {head: 'alamat', body: 'Lorem Ipsum'},
        {head: 'nama kepala sekolah', body: 'Lorem Ipsum'},
    ];

export default {
  name: 'IdentitasSekolah',
  data() {
    return {
      items
    };
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