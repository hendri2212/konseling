<template>
  <div class="c-app">
    <TheSidebar />
    <CWrapper>
      <TheHeader />
      <div class="c-body">
        <main class="c-main">
          <CContainer fluid>
            <transition name="fade" mode="out-in">
              <slot></slot>
            </transition>
          </CContainer>
        </main>
      </div>
      <TheFooter  />
    </CWrapper>
  </div>
</template>

<script>
import TheSidebar from './TheSidebar'
import TheFooter from './TheFooter'
import TheHeader from './TheHeader'

export default {
  name: 'TheContainer',
  components: {
    TheSidebar,
    TheHeader,
    TheFooter
  }
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>