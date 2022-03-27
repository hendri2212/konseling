<template>
  <CHeader fixed with-subheader light>
    <CToggler
      in-header
      class="m-3 d-lg-none"
    />
      <!-- @click="$store.commit('toggleSidebarMobile')"
    /> -->

    <!-- <CToggler
      in-header
      class="m-3 d-md-down-none"
      @click="$store.commit('toggleSidebarDesktop')"
    /> -->

    <CHeaderNav class="mr-4">
        <!-- <UserAccount /> -->
    </CHeaderNav>

    <CSubheader class="px-3">
      <CBreadcrumbRouter class="border-0 mb-0"/>
    </CSubheader>
  </CHeader>
</template>

<script>
// import { UserAccount } from "./UserAccount";

export default {
  name: 'TheHeader',
  components: {
    // UserAccount
  }
}
</script>

<style>

</style>