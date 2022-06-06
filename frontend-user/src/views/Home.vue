<template>
  <div>
    <!-- As a link -->
    <!-- <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand fs-6" href="#">
          <div>Muhammad Pazrin Andreanor</div>
          <div>X RPL</div>
        </a>
      </div>
    </nav> -->
    <div class="text-center p-2 bg-light">
      <div>
        <div class="fw-bold">Muhammad Pazrin Andreanor</div>
        <div>X RPL</div>
      </div>
    </div>

    <div class="home container-sm px-4">
      <div class="row justify-content-center">

        <div class="col-lg-9 p-md-3 py-3">
          <div class="btn-controller d-flex justify-content-between">
            <h5>Soal No. {{ this.$route.params.id }}</h5>
            <!-- <p class="fs-6">00:60:00</p> -->
            <!-- <p>{{ timer }}</p> -->
          </div>
          <span class="my-4">
            <p v-if="soal==null">Loading</p>
            <p class="fs-6" v-else v-for="(data, index) in soal" :key="index">{{ data.soal }}</p>
          </span>          

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
            <button class="btn btn-warning" v-if="this.$route.params.id==1" disabled>Kembali</button>
            <a v-else :href="parseInt(this.$route.params.id)-1" class="btn btn-warning">Kembali</a>

            <button class="btn btn-primary" v-if="this.$route.params.id==3" disabled>End</button>
            <a v-else :href="parseInt(this.$route.params.id)+1" class="btn btn-primary">Selanjutnya</a>
          </div>
          <div class="btn-controller py-4 d-flex justify-content-center">
            <a class="btn btn-success text-light" data-bs-toggle="offcanvas" href="#offcanvasSoal" role="button" aria-controls="offcanvasExample">
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
            <div v-for="(number, index) in numbers" :key="index" class="col text-center px-1 pb-1">
              <!-- <a href="#" data-bs-dismiss="offcanvas" :class="['btn', number.isAnswered ? answeredClass : defaultClass /*, activePage */ ]">{{ number.num }}</a> -->
              
              <!-- <router-link @click.native="$router.go()" :to="{ name: 'Soal', params: { id: number.num } }" data-bs-dismiss="offcanvas" :class="['btn', number.isAnswered ? answeredClass : defaultClass /*, activePage */ ]">{{ number.num }}</router-link> -->
              <router-link @click.native="$router.go()" :to="{ name: 'Soal', params: { id: number.num } }" :class="['btn', number.isAnswered ? answeredClass : defaultClass /*, activePage */ ]">{{ number.num }}</router-link>
            </div>
            <div class="col-12 py-4 text-center">
              <button type="button" class="btn btn-outline-danger">Akhiri Ujian</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
      answeredClass: 'btn-success text-light',
      defaultClass: 'btn-outline-primary',
      // activePage: isSoal === isSoalActive ? 'active' : ''
      // count: 20,
      // timer: '',
      soal: null
    }
  },
  created() {
    axios
    // .get(this.$store.state.url + 'soal')
    .get('http://127.0.0.1:8000/api/soal?page=' + this.$route.params.id)
    .then(response => {
      this.soal = response.data.data
    })
    // console.log(this.$router.currentRoute.meta.next)
    // console.log(this.$router.options.routes)
  },
  // methods: {
  //   reload() {
  //     this.$router.push(this.$route.params.id)
  //     this.$router.go(this.$route.params.id)
  //     console.log(this.$route.params.id)
  //     console.log(this.$router.currentRoute.name)
  //   }
  // }
  // watch: {
  //   count: {
  //     handler(value) {
  //       if (value > 0) {
  //         setTimeout(() => {
  //           this.count--
  //           let seconds = this.count % 60
  //           let minutes = Math.floor(this.count / 60)
  //           let hours = Math.floor(minutes / 60)
  //           minutes %= 60
  //           hours %= 60
            
  //           // save last time in server
  //           // this.count

  //           // show timer in front
  //           this.timer = `${hours} : ${minutes} : ${seconds}`
  //         }, 1000)
  //       } else {
  //         window.alert('Ujian Selesai!')
  //       }
  //     },
  //     immediate: true // This ensures the watcher is triggered upon creation
  //   }
  // },
}
</script>

<style lang="scss" scoped>
  
</style>