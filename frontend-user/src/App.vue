<template>
  <component v-if="component != ''" :is="component" :error="false" :angketnavigation="angketnavigation" :token="token">
    <router-view :token="token" :authenticated="authenticated"></router-view>
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
    ...mapState(useAuthStore, ['token']),
    angketnavigation() {
      return this.$route.meta.angketnavigation ? true : false
    }
  },
  data() {
    return {
      component: ''
    }
  },
  created() {
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
    ...mapActions(useAuthStore, ['authenticated']),
  }
}


</script>

<style scoped>

</style>
