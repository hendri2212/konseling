<template>
  <div class="home container-fluid p-4">
    <div class="row">
      <div class="col-sm-3 p-4 d-none d-lg-block border">
        <h3>soal list</h3>

        <div class="soal row row-cols-5">
          <div v-for="number in numbers" :key="number" href="#" class="col text-center px-1 pb-1">
            <a href="#" class="btn btn-outline-primary">{{ number }}</a>
          </div>
        </div>
      </div>
      <div class="col-lg-9 p-md-4 py-4 border">
        <div class="">
          <h3>Soal</h3>
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
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'

const numbers = [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]

export default {
  name: 'Home',
  data() {
    return {
      numbers,
    }
  },
  components: {
    // HelloWorld
  }
}
</script>

<style lang="scss" scoped>
  
</style>