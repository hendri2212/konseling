<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Soal AKPD

        <div class="card-header-actions">
          <CButton color="primary" @click="showModal = true"
            >Tambah Soal</CButton
          >
          <CModal title="Add Kelas" :show.sync="showModal">
            <CRow>
              <CCol sm="12">
                <CInput label="Kelas" placeholder="Masukkan Kelas" />
              </CCol>
              <CCol sm="12">
                <CInput label="Tahun" placeholder="Masukkan Tahun" />
              </CCol>
            </CRow>

            <template #footer>
              <CButton color="secondary" @click="showModal = false"
                >Close</CButton
              >
              <CButton color="primary">Save</CButton>
            </template>
          </CModal>
        </div>
      </CCardHeader>

      <CCardBody>
        <CDataTable
          :items="items"
          :fields="fields"
          column-filter
          table-filter
          items-per-page-select
          :items-per-page="5"
          hover
          sorter
          pagination
        >
          <template #show_details="{ item, index }">
            <td class="py-2">
              <CButton
                color="primary"
                variant="outline"
                square
                size="sm"
                @click="toggleDetails(item, index)"
              >
                {{ Boolean(item._toggled) ? "Hide" : "Show" }}
              </CButton>
            </td>
          </template>
          <template #details="{ item }">
            <CCollapse
              :show="Boolean(item._toggled)"
              :duration="collapseDuration"
            >
              <CCardBody>
                <CMedia :aside-image-props="{ height: 102 }">
                  <h4>Bidang: {{ item.nama_bidang }}</h4>
                  <p class="text-muted">
                    SKKPD: {{ item.SKKPD }} <br />
                    pengenalan: {{ item.pengenalan }} <br />
                    akomodasi: {{ item.akomodasi }} <br />
                    tindakan: {{ item.tindakan }}
                  </p>
                  <CButton size="sm" color="info"> Edit </CButton>
                  <CButton size="sm" color="danger" class="ml-1">
                    Delete
                  </CButton>
                </CMedia>
              </CCardBody>
            </CCollapse>
          </template>
        </CDataTable>
      </CCardBody>
    </CCard>
  </div>
</template>

<script>
// data items
const items = [
  {
    no: 1,
    soal: "Soal 1",
    rumusan_kebutuhan: "Rumusan Kebutuhan 1",
    materi: "materi 1",
    tujuan_layanan: "tujuan layanan 1",
    komponen_layanan: "komponen layanan 1",
    nama_bidang: "Nama Bidang 1",
    SKKPD: "SKKPD 1",
    pengenalan: "Pengenalan 1",
    akomodasi: "Akomodasi 1",
    tindakan: "Tindakan 1",
  },
  {
    no: 2,
    soal: "Soal 2",
    rumusan_kebutuhan: "Rumusan Kebutuhan 2",
    materi: "materi 2",
    tujuan_layanan: "tujuan layanan 2",
    komponen_layanan: "komponen layanan 2",
    nama_bidang: "Nama Bidang 2",
    SKKPD: "SKKPD 2",
    pengenalan: "Pengenalan 2",
    akomodasi: "Akomodasi 2",
    tindakan: "Tindakan 2",
  },
  {
    no: 3,
    soal: "Soal 3",
    rumusan_kebutuhan: "Rumusan Kebutuhan 3",
    materi: "materi 3",
    tujuan_layanan: "tujuan layanan 3",
    komponen_layanan: "komponen layanan 3",
    nama_bidang: "Nama Bidang 3",
    SKKPD: "SKKPD 3",
    pengenalan: "Pengenalan 3",
    akomodasi: "Akomodasi 3",
    tindakan: "Tindakan 3",
  },
];

// fields
const fields = [
  { key: "no", _style: "width:1%" },
  "soal",
  "rumusan_kebutuhan",
  "materi",
  "tujuan_layanan",
  "komponen_layanan",
  {
    key: "show_details",
    label: "",
    _style: "width:1%",
    sorter: false,
    filter: false,
    showModal: false,
  },
];

export default {
  name: "KelasPage",
  data() {
    return {
      items: items.map((item, id) => {
        return { ...item, id };
      }),
      fields,
      details: [],
      collapseDuration: 0,
      showModal: false,
    };
  },
  methods: {
    toggleDetails(item) {
      this.$set(this.items[item.id], "_toggled", !item._toggled);
      this.collapseDuration = 300;
      this.$nextTick(() => {
        this.collapseDuration = 0;
      });
    },
  },
};
</script>

<style>
</style>