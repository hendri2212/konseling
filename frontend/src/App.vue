<template>
  <div id="app">
    <transition name="fade" mode="out-in">
      <component :is="component">
        <router-view></router-view>
      </component>
    </transition>
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
      if (this.$route.name != 'AdminLogin' && this.$route.name != "Login" && this.$route.name != null) {
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
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease-in-out;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.form-control {
  color: black !important;
}
</style>
