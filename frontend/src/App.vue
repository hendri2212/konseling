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
