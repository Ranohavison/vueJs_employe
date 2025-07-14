<template>
  <div class="fixed top-0 left-0 w-full navbar bg-gradient-to-r from-base-200 to-base-300 bg-opacity-90 backdrop-blur-md border-b border-base-300 px-4 sm:px-6 lg:px-8 py-4 shadow-xl rounded-b-xl flex justify-between items-center z-50" data-aos="fade-down">
  
    <!-- Logo + Menu group -->
    <div class="flex items-center gap-6">
      <!-- Logo -->
      <a class="btn btn-ghost text-2xl font-bold font-dmserif text-primary hover:scale-105 transition-transform duration-300" href="/" aria-label="Staffy Home">🚀 Staffy</a>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex">
        <ul class="menu menu-horizontal px-2 gap-3 text-base-content font-medium">
          <li><RouterLink :to="{ hash: '#hero' }" class="relative px-4 py-2 rounded-lg hover:text-primary hover:bg-base-300 transition-all duration-300 group" aria-label="Hero">Accueil
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
          </RouterLink></li>
          <li><RouterLink :to="{ hash: '#form' }" class="relative px-4 py-2 rounded-lg hover:text-primary hover:bg-base-300 transition-all duration-300 group" aria-label="Ajout">Ajout
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
          </RouterLink></li>
          <li><RouterLink :to="{ hash: '#liste' }" class="relative px-4 py-2 rounded-lg hover:text-primary hover:bg-base-300 transition-all duration-300 group" aria-label="Liste">Liste
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
          </RouterLink></li>
          <li><RouterLink :to="{ hash: '#bilan' }" class="relative px-4 py-2 rounded-lg hover:text-primary hover:bg-base-300 transition-all duration-300 group" aria-label="Bilan">Bilan
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
          </RouterLink></li>
          <!-- <li class="relative" ref="dropdownContainer">
            <button
              class="relative px-4 py-2 rounded-lg hover:text-primary hover:bg-base-300 transition-all duration-300 group flex items-center gap-2"
              @click="toggleDropdown"
              aria-controls="dropdown-menu"
              :aria-expanded="dropdownVisible"
              aria-label="Toggle Community Menu"
            >
              Community
              <svg class="w-4 h-4 transform transition-transform duration-300" :class="{ 'rotate-180': dropdownVisible }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
              <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
            </button>
            <div
              v-if="dropdownVisible"
              id="dropdown-menu"
              class="absolute left-1/2 -translate-x-1/2 top-full mt-3 w-80 bg-gradient-to-b from-base-200 to-base-300 bg-opacity-95 backdrop-blur-md shadow-2xl rounded-xl border border-base-300 px-6 py-6 z-50"
            >
              <ul class="menu menu-vertical w-full text-base-content space-y-2">
                <li><a class="hover:text-primary transition-all duration-300 py-3 px-4 rounded-lg hover:bg-base-300" href="#" aria-label="Guides">Guides</a></li>
                <li><a class="hover:text-primary transition-all duration-300 py-3 px-4 rounded-lg hover:bg-base-300" href="#" aria-label="Questions">Questions</a></li>
                <li><a class="hover:text-primary transition-all duration-300 py-3 px-4 rounded-lg hover:bg-base-300" href="#" aria-label="Comparisons">Comparisons</a></li>
                <li><a class="hover:text-primary transition-all duration-300 py-3 px-4 rounded-lg hover:bg-base-300" href="#" aria-label="Blog">Blog</a></li>
              </ul>
            </div>
          </li> -->
        </ul>
      </div>
    </div>

    <!-- Hamburger Menu Button (Visible on Mobile) -->
    <button
      class="lg:hidden btn btn-ghost text-base-content hover:text-primary hover:scale-110 transition-all duration-300"
      @click="toggleMobileMenu"
      aria-controls="mobile-menu"
      :aria-expanded="mobileMenuVisible"
      aria-label="Toggle Mobile Menu"
    >
      <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
      </svg>
    </button>

    <!-- Mobile Menu (Slide-in) -->
    <div
      v-if="mobileMenuVisible"
      class="lg:hidden fixed left-0 w-full bg-gradient-to-b from-base-200 to-base-300 bg-opacity-95 backdrop-blur-md shadow-2xl rounded-b-xl border-b border-base-300 px-6 py-8 z-50"
      :style="{ top: `${navbarHeight}px` }"
      id="mobile-menu"
    >
      <div class="fixed inset-0 bg-black/50 z-40" @click="toggleMobileMenu" aria-hidden="true"></div>
      <ul class="menu menu-vertical w-full text-base-content space-y-3 relative z-50">
        <li><RouterLink to="/" class="hover:text-primary transition-all duration-300 py-3 px-4 rounded-lg hover:bg-base-300" @click="toggleMobileMenu" aria-label="Accueil">Accueil</RouterLink></li>
        <li><RouterLink :to="{ hash: '#hero' }" class="hover:text-primary transition-all duration-300 py-3 px-4 rounded-lg hover:bg-base-300" @click="toggleMobileMenu" aria-label="Hero">Hero</RouterLink></li>
        <li><RouterLink :to="{ hash: '#liste' }" class="hover:text-primary transition-all duration-300 py-3 px-4 rounded-lg hover:bg-base-300" @click="toggleMobileMenu" aria-label="Liste">Liste</RouterLink></li>
        <li><RouterLink :to="{ hash: '#bilan' }" class="hover:text-primary transition-all duration-300 py-3 px-4 rounded-lg hover:bg-base-300" @click="toggleMobileMenu" aria-label="Bilan">Bilan</RouterLink></li>
        <li>
          <details ref="mobileCommunityDetails">
            <summary class="hover:text-primary transition-all duration-300 cursor-pointer py-3 px-4 rounded-lg hover:bg-base-300 flex items-center gap-2" aria-label="Toggle Community Submenu">
              Community
              <svg class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </summary>
            <ul class="pl-6 pt-3 space-y-2">
              <li><a class="hover:text-primary transition-all duration-300 py-2 px-4 rounded-lg hover:bg-base-300" href="#" @click="toggleMobileMenu" aria-label="Guides">Guides</a></li>
              <li><a class="hover:text-primary transition-all duration-300 py-2 px-4 rounded-lg hover:bg-base-300" href="#" @click="toggleMobileMenu" aria-label="Questions">Questions</a></li>
              <li><a class="hover:text-primary transition-all duration-300 py-2 px-4 rounded-lg hover:bg-base-300" href="#" @click="toggleMobileMenu" aria-label="Comparisons">Comparisons</a></li>
              <li><a class="hover:text-primary transition-all duration-300 py-2 px-4 rounded-lg hover:bg-base-300" href="#" @click="toggleMobileMenu" aria-label="Blog">Blog</a></li>
            </ul>
          </details>
        </li>
        <li class="pt-6">
          <div class="flex flex-col gap-5">
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" class="sr-only peer" v-model="isDark" aria-label="Toggle Dark Mode" />
              <div class="w-16 h-9 bg-base-300 rounded-full peer peer-checked:bg-primary transition-colors duration-300"></div>
              <div class="absolute left-1.5 top-1.5 w-6 h-6 rounded-full text-white flex items-center justify-center text-sm transition-all duration-300" :class="isDark ? 'translate-x-7 bg-blue-900' : 'translate-x-0 bg-yellow-500'">
                {{ isDark ? '🌙' : '☀️' }}
              </div>
            </label>
            <div class="flex flex-col gap-4">
              <button class="btn btn-ghost text-base-content hover:text-primary rounded-full py-3 px-6 transition-all duration-300 text-left" @click="toggleMobileMenu" aria-label="Sign in">Sign in</button>
              <button class="btn btn-primary text-[clamp(0.875rem,1.5vw,1rem)] py-3 px-6 rounded-full shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 text-left" @click="toggleMobileMenu" aria-label="Sign up">Sign up</button>
            </div>
          </div>
        </li>
      </ul>
    </div>

    <!-- Dark mode + Auth buttons (Desktop) -->
    <div class="hidden lg:flex items-center gap-5">
      <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox" class="sr-only peer" v-model="isDark" aria-label="Toggle Dark Mode" />
        <div class="w-16 h-9 bg-base-300 rounded-full peer peer-checked:bg-primary transition-colors duration-300"></div>
        <div class="absolute left-1.5 top-1.5 w-6 h-6 rounded-full text-white flex items-center justify-center text-sm transition-all duration-300" :class="isDark ? 'translate-x-7 bg-blue-900' : 'translate-x-0 bg-yellow-500'">
          {{ isDark ? '🌙' : '☀️' }}
        </div>
      </label>
      <!-- <button class="btn btn-ghost text-base-content hover:text-primary rounded-full px-8 py-2.5 transition-all duration-300" aria-label="Sign in">Sign in</button>
      <button class="btn btn-primary text-[clamp(0.875rem,1.5vw,1rem)] px-8 py-2.5 rounded-full shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300" aria-label="Sign up">Sign up</button> -->
    </div>
  </div>
</template>

<script setup lang="ts">
import { useTheme } from '@/composables/useTheme'
import { ref, onMounted, onUnmounted, computed } from 'vue'
import AOS from 'aos'
import 'aos/dist/aos.css'

const { isDark } = useTheme()

const dropdownVisible = ref(false)
const mobileMenuVisible = ref(false)
const dropdownContainer = ref<HTMLElement | null>(null)
const navbarRef = ref<HTMLElement | null>(null)

const navbarHeight = computed(() => {
  return navbarRef.value ? `${navbarRef.value.offsetHeight}px` : '64px'
})

function toggleDropdown() {
  dropdownVisible.value = !dropdownVisible.value
}

function toggleMobileMenu() {
  mobileMenuVisible.value = !mobileMenuVisible.value
  if (mobileMenuVisible.value) {
    document.body.classList.add('overflow-hidden')
  } else {
    document.body.classList.remove('overflow-hidden')
  }
}

function handleClickOutside(event: MouseEvent) {
  if (dropdownContainer.value && !dropdownContainer.value.contains(event.target as Node)) {
    dropdownVisible.value = false
  }
}

onMounted(() => {
  AOS.init({
    duration: 800,
    easing: 'ease-out',
    once: true,
  })
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
  document.body.classList.remove('overflow-hidden')
})
</script>

<style scoped>
.navbar {
  overflow: visible;
}

svg.rotate-180 {
  transform: rotate(180deg);
}

/* Ensure focus states for accessibility */
button:focus,
a:focus {
  @apply outline-none ring-2 ring-primary ring-opacity-50;
}

/* Dim background when mobile menu is open */
body.overflow-hidden {
  overflow: hidden;
}
</style>