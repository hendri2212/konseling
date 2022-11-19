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
        <div class="fw-bold text-uppercase">{{ me.nama }}</div>
        <div>{{ me.kelas.nama }}</div>
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

          <div class="answer-section" v-if="soal!=null">
            <div class="list-group" v-for="(data, index) in soal" :key="'jawaban ' + index">
              <label class="list-group-item">
                <input @click="jawab(data.id, 1)" :checked="data.jawaban != null ? data.jawaban.jawaban == 1 ? true : false : false" class="form-check-input me-1" type="radio" value="1" name="jawaban" id="jawabYa">
                Ya
              </label>
              <label class="list-group-item">
                <input @click="jawab(data.id, 0)" :checked="data.jawaban != null ? data.jawaban.jawaban == 0 ? true : false : false" class="form-check-input me-1" type="radio" value="2" name="jawaban" id="jawabTidak">
                Tidak
              </label>
            </div>
          </div>

          <div class="btn-controller py-4 d-flex justify-content-between" v-if="numbers.length != 0">
            <button class="btn btn-warning" v-if="this.$route.params.id==1 || loading" disabled>Kembali</button>
            <router-link @click.native="getSoal" class="btn btn-warning" v-else :to="{name:'Soal', params:{id:parseInt(this.$route.params.id)-1}}">Kembali</router-link>
            <button class="btn btn-primary" v-if="this.$route.params.id==maxNumber" disabled>End</button>
            <button class="btn btn-primary" v-else-if="this.$route.params.id!=maxNumber && loading" disabled>Selanjutnya</button>
            <router-link @click.native="getSoal" class="btn btn-primary" v-else :to="{name:'Soal', params:{id:parseInt(this.$route.params.id)+1}}">Selanjutnya</router-link>
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
          <button type="button" class="btn-close text-reset" id="tomboloffcanvasSoal" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="soal row row-cols-5 justify-content-center">
            <div v-for="(number, index) in numbers" :key="index" class="col-3 text-center px-1 pb-1">
              <!-- <a href="#" data-bs-dismiss="offcanvas" :class="['btn', number.isAnswered ? answeredClass : defaultClass /*, activePage */ ]">{{ number.num }}</a> -->
              
              <!-- <router-link @click.native="$router.go()" :to="{ name: 'Soal', params: { id: number.num } }" data-bs-dismiss="offcanvas" :class="['btn', number.isAnswered ? answeredClass : defaultClass /*, activePage */ ]">{{ number.num }}</router-link> -->
              <router-link @click.native="changePage" :to="{ name: 'Soal', params: { id: number.num } }" style="min-width:100%;" :class="['btn', number.num == $route.params.id ? currentClass : number.isAnswered ? answeredClass : defaultClass /*, activePage */ ]">{{ number.num }}</router-link>
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
<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'
import auth from '../store/modules/auth'

export default {
  name: 'Home',
  data() {
    return {
      answeredClass: 'btn-success text-light',
      currentClass: 'btn-primary text-light',
      defaultClass: 'btn-outline-primary',
      // activePage: isSoal === isSoalActive ? 'active' : ''
      // count: 20,
      // timer: '',
      soal: null,
      loading:false,
      me: {
        nama: '',
        kelas: {
          nama: ''
        }
      }
    }
  },
  props:{
    numbers:Array,
  },
  computed: {
    maxNumber(){
      return this.numbers.length
    }
  },
  created() {
    // if (this.$store.state.auth.token == null OR this.$store.state.auth.token) {
    if (auth.getters.isAuthenticated) {
      this.axios.get('/siswa/me', {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token,
        }
      }).then(response => {
        this.me = response.data.data
      }).catch(response => {
        if (response.response.status == 401) {
          localStorage.removeItem('STUDENT_TOKEN')
          this.$router.push({name: 'login'})
        }
      })
    } else {
      console.log('belum login')
    }

    this.axios.get('/siswa/list-soal', {
      headers: {
        Authorization: "Bearer " + this.$store.state.auth.token,
      }
    }).then(response => {
      this.$store.commit('soal/setNumbers', response.data.data)
      // this.numbers = response.data.data
    })
    this.getSoal()
  },
  methods: {
    getSoal(){
      this.soal = null
      this.axios.get('/siswa/soal?page=' + this.$route.params.id, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token,
        }
      }).then(response => {
        this.soal = response.data.data
      })
    },
    async changePage(){
      await this.getSoal()
      document.getElementById("tomboloffcanvasSoal").click()
    },
    jawab(id, j){
      this.loading = true
      this.axios.post('/siswa/soal/jawab', {
        id: id,
        jawaban: j,
      }, {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token,
        }
      }).then(() => {
        this.$store.commit('soal/setAnswered', parseInt(this.$route.params.id)-1)
        this.loading = false
      })
    }
  }
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