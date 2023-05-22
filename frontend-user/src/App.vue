<template>
  <component v-if="component != ''" :is="component" :error="false" :angketnavigation="angketnavigation" :token="token">
    <router-view v-bind="data_props"></router-view>
  </component>
</template>

<script>
import { RouterView } from 'vue-router'
import LayoutDefault from '@/components/layout/LayoutDefault.vue';
import LayoutAuthentication from '@/components/layout/LayoutAuthentication.vue';
import { mapState, mapActions } from 'pinia'
import { useAuthStore } from '@/stores/auth'

export default {
  name: "App",
  components: {
    LayoutDefault,
    LayoutAuthentication,
  },
  computed: {
    ...mapState(useAuthStore, ['token', 'isAuthenticated']),
    angketnavigation() {
      return this.$route.meta.angketnavigation ? true : false
    },
    data_props() {
      if (this.$route.name != "Login") {
        return {
          token: this.token,
          authenticated: this.authenticated
        }
      }
      return {
        authenticated: this.authenticated
      }
    }
  },
  data() {
    return {
      component: ''
    }
  },
  created() {
    if (this.isAuthenticated) {
      let headers = {
        headers: {
          Authorization: "Bearer " + this.token
        }
      }
      this.axios.get('me', headers).catch(() => {
        this.logout()
        this.$router.push({ name: "Login" })
      })
    }
    this.$watch(
      () => this.$route.meta,
      (toParams, previousParams) => {
        if (this.$route.meta.authentication) {
          this.component = 'LayoutAuthentication'
        } else {
          this.component = 'LayoutDefault'
        }
      }
    )
  },
  methods: {
    ...mapActions(useAuthStore, ['authenticated', 'logout']),
  }
}


</script>
