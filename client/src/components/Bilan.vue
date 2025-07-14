<template>
  <div class="relative min-h-screen bg-cover bg-center bg-fixed bg-base-100 overflow-hidden" id="bilan">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-base-100/80 to-accent/10 z-0"></div>

    <!-- Animated Background Shapes -->
    <div class="absolute inset-0 z-0">
      <div class="absolute top-20 right-20 w-28 h-28 bg-secondary rounded-full opacity-40" data-aos="fade-down" data-aos-delay="100"></div>
      <div class="absolute top-40 right-40 w-36 h-36 bg-accent rounded-full opacity-40" data-aos="fade-down" data-aos-delay="300"></div>
      <div class="absolute top-60 right-60 w-24 h-24 bg-primary rounded-full opacity-40" data-aos="fade-down" data-aos-delay="500"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between px-8 py-16 lg:py-24 lg:px-32 min-h-screen">
      
      <!-- Text on the Left -->
      <div class="lg:w-1/2 text-left space-y-10 mb-12 lg:mb-0" data-aos="fade-right">
        <h1 class="font-bold font-dmserif text-primary text-[clamp(3rem,7vw,5rem)] leading-tight tracking-tight" aria-label="Bilan des Employés">
          Bilan <br />
          <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-accent">
            Financier
          </span> <br />
          des Employés
        </h1>
        <div class="text-base-content/90 text-[clamp(1.25rem,2.5vw,1.75rem)] leading-relaxed max-w-2xl font-medium" data-aos="fade-up" data-aos-delay="200">
          <p v-if="employees.length === 0" class="text-center">
            Aucun employé disponible pour le bilan.
          </p>
          <div v-else class="space-y-6">
            <div class="bg-neutral/50 backdrop-blur-sm p-6 rounded-lg shadow-lg" aria-label="Statistiques des salaires">
              <p class="text-lg font-semibold">
                Salaire Total: <span class="text-accent">{{ totalSalary.toLocaleString() }} Ar</span>
              </p>
              <p class="text-lg font-semibold">
                Salaire Minimum: <span class="text-accent">{{ minSalary.toLocaleString() }} Ar</span>
              </p>
              <p class="text-lg font-semibold">
                Salaire Maximum: <span class="text-accent">{{ maxSalary.toLocaleString() }} Ar</span>
              </p>
            </div>
            <!-- Text-based summary for accessibility -->
            <!-- <div class="text-sm text-base-content/70" aria-label="Résumé de la distribution des salaires">
              <p>Distribution des salaires :</p>
              <ul>
                <li v-for="(count, index) in histogramData" :key="index">
                  {{ histogramLabels[index] }} : {{ count }} employé{{ count > 1 ? 's' : '' }}
                </li>
              </ul>
            </div> -->
          </div>
        </div>
        <div class="flex flex-wrap gap-6" data-aos="zoom-in" data-aos-delay="400">
          <RouterLink :to="{ hash: '#liste' }" class="btn btn-primary text-base-content text-[clamp(0.875rem,1.5vw,1rem)] px-10 py-4 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 bg-gradient-to-r from-primary to-accent" aria-label="Voir la liste des employés">
            Voir la liste
          </RouterLink>
          <!-- <button class="btn btn-outline text-base-content text-[clamp(0.875rem,1.5vw,1rem)] px-10 py-4 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 border-primary hover:bg-primary/10" aria-label="Exporter le bilan">
            Exporter le bilan
          </button> -->
        </div>
      </div>

      <!-- Histogram on the Right -->
      <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="300">
        <div v-if="employees.length === 0" class="text-center text-base-content/90 text-lg">
          Aucune donnée pour afficher l'histogramme.
        </div>
        <div v-else class="w-full max-w-lg mx-auto bg-neutral/50 backdrop-blur-sm p-6 rounded-lg shadow-lg" aria-label="Histogramme des salaires">
          <VueApexCharts
            type="bar"
            height="400"
            :options="chartOptions"
            :series="chartSeries"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AOS from 'aos'
import 'aos/dist/aos.css'
import VueApexCharts from 'vue3-apexcharts'

export default {
  name: 'Bilan',
  components: {
    VueApexCharts
  },
  props: {
    employees: {
      type: Array,
      required: true,
      default: () => [],
      validator: (employees) => {
        return employees.every(emp => 
          typeof emp.numEmp === 'string' &&
          typeof emp.nom === 'string' &&
          typeof emp.salaire === 'number'
        )
      }
    }
  },
  computed: {
    totalSalary() {
      return this.employees.reduce((sum, emp) => sum + emp.salaire, 0)
    },
    minSalary() {
      return this.employees.length > 0 ? Math.min(...this.employees.map(emp => emp.salaire)) : 0
    },
    maxSalary() {
      return this.employees.length > 0 ? Math.max(...this.employees.map(emp => emp.salaire)) : 0
    },
    histogramData() {
      if (this.employees.length === 0) return []
      
      // Fixed bins: < 1000, 1000-5000, > 5000
      const bins = [
        this.employees.filter(emp => emp.salaire < 1000).length,
        this.employees.filter(emp => emp.salaire >= 1000 && emp.salaire <= 5000).length,
        this.employees.filter(emp => emp.salaire > 5000).length
      ]
      
      return bins
    },
    histogramLabels() {
      return ['Médiocre', 'Moyen', 'Grand']
    },
    chartSeries() {
      return [{
        name: 'Nombre d\'employés',
        data: this.histogramData
      }]
    },
    chartOptions() {
      return {
        chart: {
          type: 'bar',
          background: 'transparent',
          toolbar: { show: false }
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            columnWidth: '80%' // Adjust bar width for histogram look
          }
        },
        xaxis: {
          categories: this.histogramLabels,
          title: {
            text: 'Salaire (Ar)',
            style: {
              color: '#4B5EAA', // Matches Tailwind's primary color
              fontFamily: 'DM Serif Display, serif',
              fontSize: '16px'
            }
          },
          labels: {
            style: {
              colors: '#4B5EAA',
              fontFamily: 'DM Serif Display, serif'
            }
          }
        },
        yaxis: {
          title: {
            text: 'Nombre d\'employés',
            style: {
              color: '#4B5EAA',
              fontFamily: 'DM Serif Display, serif',
              fontSize: '16px'
            }
          },
          labels: {
            style: {
              colors: '#4B5EAA',
              fontFamily: 'DM Serif Display, serif'
            }
          }
        },
        colors: ['#F472B6'], // Matches Tailwind's accent color
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: 'vertical',
            shadeIntensity: 0.25,
            gradientToColors: ['#4B5EAA'], // Matches Tailwind's primary color
            inverseColors: false,
            opacityFrom: 0.85,
            opacityTo: 0.85
          }
        },
        dataLabels: { enabled: false },
        grid: {
          borderColor: '#4B5EAA20'
        },
        tooltip: {
          theme: 'dark',
          style: {
            fontFamily: 'DM Serif Display, serif'
          }
        }
      }
    }
  },
  mounted() {
    AOS.init({
      duration: 800,
      easing: 'ease-out',
      once: true
    })
  }
}
</script>

<style scoped>
.chart-container {
  max-width: 100%;
}
</style>
