<script setup lang="ts">
import { useTheme } from '@/composables/useTheme'

const { currentTheme } = useTheme()
</script>

<template>
  <div :data-theme="currentTheme">
    <RouterView />
  </div>
</template>

<style lang="scss">
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: inherit;
    color: whitesmoke;
  }
</style>


