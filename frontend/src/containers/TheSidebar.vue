<template>
  <CSidebar 
    fixed
    :minimize="minimize"
    :show="show"
    @update:show="check"
  >
    <CSidebarBrand class="d-md-down-none" to="/">
      <CIcon 
        class="c-sidebar-brand-full" 
        name="logo" 
        size="custom-size" 
        :height="35" 
        viewBox="0 0 556 134"
      />
      <CIcon 
        class="c-sidebar-brand-minimized" 
        name="logo" 
        size="custom-size" 
        :height="35" 
        viewBox="0 0 110 134"
      />
      <CBadge color="success">Beta</CBadge>
    </CSidebarBrand>

    <CRenderFunction flat :content-to-render="navComputed"/>
    <CSidebarMinimizer
      class="d-md-down-none"
      @click.native="$store.commit('sidebar/set', ['sidebarMinimize', !minimize])"
    />
  </CSidebar>
</template>

<script>
import nav from './_nav'
import nav_guru from './_nav_guru'
import nav_admin from './_nav_admin'

export default {
  name: 'TheSidebar',
  nav,
  nav_guru,
  nav_admin,
  computed: {
    navComputed() {
      if (this.$store.getters['auth/isAdmin']) {
        return this.$options.nav_admin
      } else if (this.$store.getters['auth/isSekolah']) {
        return this.$options.nav
      } else if (this.$store.getters['auth/isGuru']) {
        return this.$options.nav_guru
      } else {
        return []
      }
    },
    show() {
      return this.$store.state.sidebar.sidebarShow 
    },
    minimize() {
      return this.$store.state.sidebar.sidebarMinimize 
    }
  },
  methods: {
    check(data) {
      if (data == 'responsive') {
        this.$store.commit('sidebar/toggleSidebarMobile')
      }
    }
  }
}
</script>

<style>

</style>