<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Jawaban Peserta Didik
      </CCardHeader>

      <CCardBody>
        <CDataTable
          :items="items"
          :fields="fields"
          table-filter
          items-per-page-select
          :items-per-page="5"
          hover
          pagination
        >
        </CDataTable>
      </CCardBody>
    </CCard>
  </div>
</template>

<script>

// data items
const items = [
  { no: 1, nama: "Ryan", kelas: "X RPL", soal_1: 0, soal_2: 1, soal_3: 0, soal_4: 0, soal_5: 1 },
  { no: 2, nama: "Ryan", kelas: "X RPL", soal_1: 0, soal_2: 1, soal_3: 0, soal_4: 0, soal_5: 1 },
  { no: 3, nama: "Ryan", kelas: "X RPL", soal_1: 0, soal_2: 1, soal_3: 0, soal_4: 0, soal_5: 1 }
];

// fields
const fields = [
  { key: "no", _style: "width:1%", filter: true },
  { key: "nama" },
  { key: "kelas" },
  { key: "soal_1" },
  { key: "soal_2" },
  { key: "soal_3" },
  { key: "soal_4" },
  { key: "soal_5" },
];

export default {
  name: "JawabanPage",
  data() {
    return {
      items: items.map((item, id) => {
        return { ...item, id };
      }),
      fields,
    };
  }
}
</script>

<style></style>