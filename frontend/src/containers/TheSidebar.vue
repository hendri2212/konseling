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

    <CRenderFunction flat :content-to-render="$options.nav"/>
    <CSidebarMinimizer
      class="d-md-down-none"
      @click.native="$store.commit('sidebar/set', ['sidebarMinimize', !minimize])"
    />
  </CSidebar>
</template>

<script>
import nav from './_nav'

export default {
  name: 'TheSidebar',
  nav,
  computed: {
    show () {
      return this.$store.state.sidebar.sidebarShow 
    },
    minimize () {
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