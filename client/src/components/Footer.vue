<template>
  <footer class="bg-base-100 text-base-content py-8 px-4 lg:px-24"  data-aos="fade-up">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Brand Section -->
      <div class="space-y-4">
        <h3 class="text-xl font-bold font-dmserif">🚀 Staffy</h3>
        <p class="text-sm text-base-content/70">Your one-stop platform for free design assets and creative inspiration.</p>
      </div>

      <!-- Secondary Navigation -->
      <div class="space-y-4">
        <h4 class="text-lg font-semibold">Navigation</h4>
        <ul class="space-y-2">
          <li><RouterLink :to="{ hash: '#hero' }" class="text-base-content/80 hover:text-base-content transition-colors duration-300">Hero</RouterLink></li>
          <li><RouterLink :to="{ hash: '#liste' }" class="text-base-content/80 hover:text-base-content transition-colors duration-300">liste</RouterLink></li>
          <li><RouterLink :to="{ hash: '#bilan' }" class="text-base-content/80 hover:text-base-content transition-colors duration-300">bilan</RouterLink></li>
        </ul>
      </div>

      <!-- Legal & Contact -->
      <div class="space-y-4">
        <div>
          <h4 class="text-lg font-semibold">Legal & Contact</h4>
          <ul class="space-y-2">
            <li><a href="/legal" class="text-base-content/80 hover:text-base-content transition-colors duration-300">Mentions légales</a></li>
            <li><a href="/privacy" class="text-base-content/80 hover:text-base-content transition-colors duration-300">Politique de confidentialité</a></li>
            <li><a href="/terms" class="text-base-content/80 hover:text-base-content transition-colors duration-300">CGU</a></li>
          </ul>
        </div>
        <div class="mt-4">
          <p class="text-sm text-base-content/70">Support: <a href="mailto:support@betterstack.com" class="hover:text-base-content">support@betterstack.com</a></p>
          <a href="https://www.linkedin.com/company/betterstack" target="_blank" class="text-base-content/80 hover:text-base-content transition-colors duration-300 mt-2 inline-block">LinkedIn</a>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="mt-8 pt-4 border-t border-base-content/20 text-center text-sm text-base-content/70">
      <p>© 2025 BetterStack. All rights reserved.</p>
      <p>App Version: v1.0.0</p>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { RouterLink } from 'vue-router'
</script>

<style scoped>
/* No additional styles needed; Tailwind handles responsiveness */
</style>