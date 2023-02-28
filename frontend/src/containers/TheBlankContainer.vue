<template>
    <div class="c-app">
      <CWrapper>
        <div class="c-body">
          <main class="c-main">
            <CContainer fluid>
              <transition name="fade" mode="out-in">
                <slot></slot>
              </transition>
            </CContainer>
          </main>
        </div>
      </CWrapper>
    </div>
  </template>
  
  <script>
  
  export default {
    name: 'TheBlankContainer',
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