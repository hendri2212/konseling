<template>
  <div class="home container-sm p-4">
    <div class="row justify-content-center">

      <div class="col-lg-9 p-md-4 py-4 border">
        <div class="btn-controller pb-4 d-flex justify-content-between">
          <h3>Soal 1</h3>
          <p class="fs-6">00:60:00</p>
        </div>
        <div class="">
          <span class="my-4">
            <p class="fs-6">Saya merasa belum disiplin dalam beribadah pada Tuhan YME</p>
          </span>          
        </div>

        <div class="answer-section">
          <div class="list-group">
            <label class="list-group-item">
              <input class="form-check-input me-1" type="radio" value="1" name="jawaban" id="jawabYa">
              Ya
            </label>
            <label class="list-group-item">
              <input class="form-check-input me-1" type="radio" value="2" name="jawaban" id="jawabTidak">
              Tidak
            </label>
          </div>
        </div>

        <div class="btn-controller py-4 d-flex justify-content-between">
          <button type="button" class="btn btn-warning">Kembali</button>
          <button type="button" class="btn btn-primary">Selanjutnya</button>
        </div>
        <div class="btn-controller py-4 d-flex justify-content-center">
          <a class="btn btn-outline-success" data-bs-toggle="offcanvas" href="#offcanvasSoal" role="button" aria-controls="offcanvasExample">
            Daftar Soal
          </a>
        </div>

      </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSoal" aria-labelledby="offcanvasSoalLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasSoalLabel">Daftar Soal</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="soal row row-cols-5">
          <div v-for="number in numbers" :key="number" class="col text-center px-1 pb-1">
            <a href="#" :class="['btn', number.isAnswered ? answeredClass : defaultClass /*, activePage */ ]">{{ number.num }}</a>
          </div>
          <div class="col-12 py-4 text-center">
            <button type="button" class="btn btn-outline-danger">Akhiri Ujian</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'

const numbers = [
  { num: 1, isAnswered: false },
  { num: 2, isAnswered: true },
  { num: 3, isAnswered: true },
  { num: 4, isAnswered: false },
  { num: 5, isAnswered: false }
]

export default {
  name: 'Home',
  data() {
    return {
      numbers,
      answeredClass: 'btn-success',
      defaultClass: 'btn-outline-primary',
      // activePage: isSoal === isSoalActive ? 'active' : ''
    }
  }
}
</script>

<style lang="scss" scoped>
  
</style>