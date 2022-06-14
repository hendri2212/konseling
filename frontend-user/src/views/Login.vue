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
              <label class="form-label">Email address</label>
              <input type="email" class="form-control" placeholder="name@example.com" v-model="email">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" v-model="password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Home',
  data() {
    return {
      email: "",
      password: ""
    }
  },
  methods: {
    login(){
      this.axios.post('/siswa/login', {
        email: this.email,
        password: this.password,
      }).then(response => {
        localStorage.setItem(this.$store.state.auth.nameLocalStorage, response.data.data.token)
        this.$store.dispatch('auth/authenticated', {token:response.data.data.token})
        this.$router.push({name:"home"})
      })
    }
  }
}
</script>

<style lang="scss" scoped>
  
</style>