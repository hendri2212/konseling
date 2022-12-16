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
        <div class="fw-bold">LOGIN</div>
        <!-- <div>X RPL</div> -->
      </div>
    </div>

    <div class="home container-sm px-4">
      <div class="row justify-content-center">
        <div class="col-lg-9 p-md-3 py-3">
          <form @submit.prevent="login">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" placeholder="Your username" v-model="username">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" placeholder="Your password" v-model="password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
    <loading ref="loading"></loading>
  </div>
</template>

<script>
import Loading from "@/components/Loading.vue"
import Swal from 'sweetalert2'
export default {
  name: 'Login',
  components: {
    Loading,
  },
  data() {
    return {
      username: "",
      password: ""
    }
  },
  methods: {
    async login() {
      this.$refs.loading.show()
      try {
        const { data } = await this.axios.post('/siswa/login', {
          username: this.username,
          password: this.password,
        })
        this.$refs.loading.hide()
        console.log(data)
      } catch (e) {
        this.$refs.loading.hide()
        if (e.response) {
          Swal.fire({
            icon: 'error',
            text: e.response.data.message,
          })
        }
      }
      // localStorage.setItem(this.$store.state.auth.nameLocalStorage, response.data.data.token)
      // this.$store.dispatch('auth/authenticated', { token: response.data.data.token })
      // this.$router.push({ name: "home" })
    }
  }
}
</script>

<style lang="scss" scoped>

</style>