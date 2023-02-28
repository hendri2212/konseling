<template>
    <CDataTable :responsive="true" :items="items" :fields="fields" hover>

    </CDataTable>
</template>
<script>

const fields = [
  { label: '', key: 'ProfileSiswa' },
  { label: 'Nama', key: 'nama' },
  { label: 'Status', key: 'status' },
  { label: 'Dimulai pada', key: 'timestart' },
  { label: 'Selesai', key: 'timefinish' },
  { label: 'Waktu mengerjakan', key: 'time' }
]

export default {
    name: "Hasil",
    data() {
        return {
            fields: fields,
            items: [],
        }
    }
}
</script>