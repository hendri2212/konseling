<template>
  <CHeader fixed with-subheader light>
    <CToggler
      in-header
      class="m-3 d-lg-none"
      @click="$store.commit('sidebar/toggleSidebarMobile')"
    />

    <!-- <CToggler
      in-header
      class="m-3 d-md-down-none"
      @click="$store.commit('toggleSidebarDesktop')"
    /> -->
    
    <CHeaderBrand class="mx-auto d-lg-none" to="/">
      <CIcon name="logo" height="48" alt="Logo"/>
    </CHeaderBrand>

    <CHeaderNav class="d-md-down-none mr-auto">
      <!-- <CHeaderNavItem class="px-3">
        <CHeaderNavLink to="/dashboard">
          Dashboard
        </CHeaderNavLink>
      </CHeaderNavItem>
      <CHeaderNavItem class="px-3">
        <CHeaderNavLink to="/users" exact>
          Users
        </CHeaderNavLink>
      </CHeaderNavItem>
      <CHeaderNavItem class="px-3">
        <CHeaderNavLink>
          Settings
        </CHeaderNavLink>
      </CHeaderNavItem> -->
    </CHeaderNav>

    <CHeaderNav in-header>
        <!-- <UserAccount /> -->
        <TheHeaderDropdownAccnt/>
    </CHeaderNav>

    <CSubheader class="px-3">
      <CBreadcrumbRouter class="border-0 mb-0"/>
    </CSubheader>
  </CHeader>
</template>

<script>
import TheHeaderDropdownAccnt from '@/components/TheHeaderDropdownAccnt.vue'
// import { UserAccount } from "./UserAccount";

export default {
  name: 'TheHeader',
  components: {
    TheHeaderDropdownAccnt
    // UserAccount
  }
}
</script>

<style>

</style>