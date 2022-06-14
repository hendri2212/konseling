<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
  components: {

  },
  created(){
    let headers = {
      headers: {
        Authorization: "Bearer " + this.$store.state.auth.token
      }
    }
    this.axios.get('me', headers).then(response => {
      this.$store.dispatch('auth/logedAs', response.data.data.as)
    })
  }
}
</script>

<style lang="scss">
  // Import Main styles for this application
  @import 'assets/scss/style';

</style>
