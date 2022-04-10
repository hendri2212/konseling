<template>
  <CModal title="Add Edit Soal" color="primary" size="lg" :show.sync="showModal">
    <CRow>
      <CCol sm="12">
        <CTextarea
          label="Soal"
          type="text"
          placeholder="Masukkan Soal"
          v-model="data.soal"
        />
      </CCol>
      <CCol sm="6">
        <CInput
          label="Rumusan Kebutuhan"
          type="text"
          placeholder="Masukkan Rumusah kebutuhan"
          v-model="data.rumusan_kebutuhan"
        />
      </CCol>
      <CCol sm="6">
        <CInput
          label="Materi"
          type="text"
          placeholder="Masukkan materi"
          v-model="data.materi"
        />
      </CCol>
      <CCol sm="6">
        <CInput
          label="Tujuan Layanan"
          type="text"
          placeholder="Masukkan Tujuan Layanan"
          v-model="data.tujuan_layanan"
        />
      </CCol>
      <CCol sm="6">
        <CInput
          label="Komponen Layanan"
          type="text"
          placeholder="Masukkan Komponen Layanan"
          v-model="data.komponen_layanan"
        />
      </CCol>
      <CCol sm="6">
        <CSelect
          label="Nama Bidang"
          v-model="data.nama_bidang"
          :options="[{ label: '- Pilih Bidang -' }, ...nama_bidang]"
        />
      </CCol>
      <CCol sm="6">
        <CSelect
          label="Kompetensi"
          v-model="data.kompetensi"
          :options="[{ label: '- Pilih Kompetensi -' }, ...kompetensi]"
        />
      </CCol>
    </CRow>

    <template #footer>
      <CButton color="secondary" @click="showModal = false">Close</CButton>
      <CButton color="primary" @click="save">Save</CButton>
    </template>
  </CModal>
</template>

<script>

const nama_bidang = [
  "bidang 1",
  "bidang 2",
  "bidang 3",
]

const kompetensi = [
  "kompetensi 1",
  "kompetensi 2",
  "kompetensi 3",
]

export default {
  name: 'SoalModal',
  data() {
    return {
      nama_bidang,
      kompetensi,
      data: {
        id: null,
        soal: null,
        rumusan_kebutuhan: null,
        materi: null,
        tujuan_layanan: null,
        komponen_layanan: null,
        nama_bidang,
        kompetensi,
      },
      insertModal: true,
      showModal: false,
    }
  },
  methods: {
    setModal(stat, data = null) {
      this.showModal = stat;
      if (data != null) {
        this.insertModal = false;
        this.data = data;
      } else {
        this.insertModal = true;
        this.data.id = null;
        this.data.soal = null;
        this.data.rumusan_kebutuhan = null;
        this.data.materi = null;
        this.data.tujuan_layanan = null;
        this.data.komponen_layanan = null;
        this.data.nama_bidang = null;
        this.data.kompetensi = null;
      }
    },
    save() {
      if (this.insertModal) {
        console.log(this.data);
      } else {
        console.log("edit");
        console.log(this.data);
      }
    },
  },
}
</script>

<style>

</style>