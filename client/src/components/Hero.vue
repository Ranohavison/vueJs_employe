<template>
  <div class="mt-12 relative min-h-screen bg-cover bg-center bg-fixed bg-base-100 overflow-hidden" id="hero">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-base-100/80 to-accent/10 z-0"></div>

    <!-- Animated Background Shapes -->
    <div class="absolute inset-0 z-0">
      <div class="absolute top-20 right-20 w-28 h-28 bg-secondary rounded-full opacity-40" data-aos="fade-down" data-aos-delay="100"></div>
      <div class="absolute top-40 right-40 w-36 h-36 bg-accent rounded-full opacity-40" data-aos="fade-down" data-aos-delay="300"></div>
      <div class="absolute top-60 right-60 w-24 h-24 bg-primary rounded-full opacity-40" data-aos="fade-down" data-aos-delay="500"></div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between px-8 py-16 lg:py-24 lg:px-32 min-h-screen">
      
      <!-- TEXT ON THE LEFT -->
      <div class="lg:w-1/2 text-left space-y-10 mb-12 lg:mb-0" data-aos="fade-right">
        <h1 class="font-bold font-dmserif text-primary text-[clamp(3rem,7vw,5rem)] leading-tight tracking-tight">
          Gérer <br />
          <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-accent">
            vos employés
          </span> <br />
          efficacement!
        </h1>
        <p class="text-base-content/90 text-[clamp(1.25rem,2.5vw,1.75rem)] leading-relaxed max-w-2xl font-medium" data-aos="fade-up" data-aos-delay="200">
          Une solution complète pour ajouter, suivre et analyser les données du personnel. Idéal pour les PME et les gestionnaires RH.
        </p>
        <div class="flex flex-wrap gap-6" data-aos="zoom-in" data-aos-delay="400">
          <RouterLink :to="{ hash: '#form' }" class="btn btn-primary text-base-content text-[clamp(0.875rem,1.5vw,1rem)] px-10 py-4 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 bg-gradient-to-r from-primary to-accent">
            Ajouter un employé
          </RouterLink>
          <RouterLink :to="{ hash: '#bilan' }" class="btn btn-outline text-base-content text-[clamp(0.875rem,1.5vw,1rem)] px-10 py-4 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 border-primary hover:bg-primary/10">
            Voir les statistiques
          </RouterLink>
        </div>
      </div>

      <!-- IMAGE OR ILLUSTRATION ON THE RIGHT -->
      <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="300">
        <img src="@/assets/images/hero-image.png" alt="Illustration" class="w-full max-w-lg mx-auto drop-shadow-2xl" />
      </div>
    </div>
  </div>
</template>

<script>
import AOS from 'aos'
import 'aos/dist/aos.css'
import { RouterLink } from 'vue-router';

export default {
  name: 'Hero',
  mounted() {
    AOS.init({
      duration: 800,
      easing: 'ease-out',
      once: true,
    })
  }
}
</script>

<style scoped>
/* No additional styles needed as AOS handles animations */
</style>