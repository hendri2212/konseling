<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Soal AKPD

        <div class="card-header-actions">
          <CButton color="primary" @click="$refs.addModal.setModal(true)">Tambah Soal</CButton>

          <SoalModal ref="addModal"></SoalModal>
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
                  <table>
                    <thead>
                      <th>Bidang</th>
                      <th>SKKPD</th>
                      <th>Pengenalan</th>
                      <th>Akomodasi</th>
                      <th>Tindakan</th>
                    </thead>
                    <tbody>
                      <td>{{ item.nama_bidang }}</td>
                      <td>{{ item.SKKPD }}</td>
                      <td>{{ item.pengenalan }}</td>
                      <td>{{ item.akomodasi }}</td>
                      <td>{{ item.tindakan }}</td>
                      <td>
                        <CButton size="sm" color="info" @click="$refs.addModal.setModal(true, item)"> Edit </CButton>
                        <CButton size="sm" color="danger" class="ml-1" @click="(deleteData.id = item.id), (deleteData.modal = true)">
                          Delete
                        </CButton>
                      </td>
                    </tbody>
                  </table>
                </CMedia>
              </CCardBody>
            </CCollapse>
          </template>
        </CDataTable>

        <CModal title="Hapus Soal" color="danger" :show.sync="deleteData.modal">
          {{ deleteData.id }} delete Permanent?
          <template #footer>
            <CButton color="primary" variant="outline" @click="deleteData.modal = false">Close</CButton>
            <CButton @click="deleteSoal">Yes</CButton>
          </template>
        </CModal>
      </CCardBody>
    </CCard>
  </div>
</template>

<script>
import SoalModal from "./SoalModal.vue";

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
    filter: false
  },
];

export default {
  name: "KelasPage",
  components: {
    SoalModal,
  },
  data() {
    return {
      items: items.map((item, id) => {
        return { ...item, id };
      }),
      fields,
      details: [],
      collapseDuration: 0,
      deleteData: {
        id: null,
        modal: false,
      },
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
    deleteSoal() {
      console.log(this.deleteData.id);
      // di sini fungsi axios

      // hapus data di frontend
      this.items.splice(this.deleteData.id, 1);

      this.deleteData.modal = false;
    },
  },
};
</script>

<style>
</style>