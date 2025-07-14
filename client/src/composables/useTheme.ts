// composables/useTheme.ts
import { ref, watch } from 'vue'

const isDark = ref<boolean>(false)
const currentTheme = ref<'main_light' | 'main_dark'>('main_light')

// Charger le thème sauvegardé
const savedTheme = localStorage.getItem('theme')
if (savedTheme === 'main_dark') {
  isDark.value = true
  currentTheme.value = 'main_dark'
}

watch(isDark, (val) => {
  currentTheme.value = val ? 'main_dark' : 'main_light'
  localStorage.setItem('theme', currentTheme.value)
})

export function useTheme() {
  return { isDark, currentTheme }
}
