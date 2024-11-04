<template>
  <div id="app">
    <component :is="component">
      <router-view></router-view>
    </component>
  </div>
</template>

<script>
import TheBlankContainer from './containers/TheBlankContainer.vue'
import TheContainer from './containers/TheContainer.vue'
export default {
  name: 'App',
  components: {
    TheBlankContainer,
    TheContainer,
  },
  computed: {
    component() {
      if (this.$route.name != 'AdminLogin' && this.$route.name != "Login" && this.$route.name != "Error404" && this.$route.name != null) {
        return "TheContainer"
      }
      return "TheBlankContainer"

    }
  },
  created() {
    if (this.$store.getters['auth/isAuthenticated']) {
      let headers = {
        headers: {
          Authorization: "Bearer " + this.$store.state.auth.token
        }
      }
      this.axios.get('me', headers).then(response => {
        this.$store.dispatch('auth/logedAs', response.data.data.as)
      }).catch(() => {
        this.$store.dispatch('auth/logout')
        this.$router.push({ name: 'Login' })
      })
    }
  }
}
</script>

<style>
.form-control {
  color: black !important;
}
</style>
