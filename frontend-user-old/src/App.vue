<template>
  <div id="app">
    <!-- <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container"> -->
        <router-view></router-view>
      <!-- </div>
    </div> -->
  </div>
</template>
<script>
export default {
  name: "App",
  created() {
    // this.axios.get('/siswa/list-soal', {
    //   headers: {
    //     Authorization: "Bearer " + this.$store.state.auth.token,
    //   }
    // }).then(response => {
    //   this.$store.commit('soal/setNumbers', response.data.data)
    //   // this.numbers = response.data.data
    // })
  }
}
</script>

<style lang="scss">
// #app {
//   font-family: Avenir, Helvetica, Arial, sans-serif;
//   -webkit-font-smoothing: antialiased;
//   -moz-osx-font-smoothing: grayscale;
//   text-align: center;
//   color: #2c3e50;
// }

// nav {
//   padding: 30px;

//   a {
//     font-weight: bold;
//     color: #2c3e50;

//     &.router-link-exact-active {
//       color: #42b983;
//     }
//   }
// }
</style>
