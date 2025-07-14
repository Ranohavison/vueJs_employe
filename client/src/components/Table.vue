<template>
  <div class="relative bg-base-100 py-16 px-8 lg:px-32" id="liste">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-base-100/80 to-accent/10 z-0"></div>
    
    <!-- Animated Background Shapes -->
    <div class="absolute inset-0 z-0">
      <div class="absolute top-20 right-20 w-28 h-28 bg-secondary rounded-full opacity-40" data-aos="fade-down" data-aos-delay="100"></div>
      <div class="absolute top-40 right-40 w-36 h-36 bg-accent rounded-full opacity-40" data-aos="fade-down" data-aos-delay="300"></div>
      <div class="absolute top-60 right-60 w-24 h-24 bg-primary rounded-full opacity-40" data-aos="fade-down" data-aos-delay="500"></div>
    </div>
    
    <!-- Main Content -->
    <div class="relative z-10">
      <h1 class="font-bold font-dmserif text-primary text-[clamp(2.5rem,6vw,4rem)] leading-tight tracking-tight text-center mb-12" data-aos="fade-up">
        Liste des Employés
      </h1>
      
      <!-- Search Input -->
      <div class="mb-6 flex justify-center" data-aos="fade-up" data-aos-delay="100">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Rechercher un employé..."
          class="input input-bordered w-full max-w-md bg-neutral/20 text-base-content"
          aria-label="Rechercher un employé"
        />
      </div>

      <div class="bg-neutral/50 backdrop-blur-sm p-8 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="200">
        <div class="overflow-x-auto">
          <table class="table w-full">
            <thead>
              <tr class="text-base-content/90">
                <th class="bg-neutral/20 text-[clamp(0.875rem,1.5vw,1rem)] font-dmserif font-semibold">Numero</th>
                <th class="bg-neutral/20 text-[clamp(0.875rem,1.5vw,1rem)] font-dmserif font-semibold">Nom</th>
                <th class="bg-neutral/20 text-[clamp(0.875rem,1.5vw,1rem)] font-dmserif font-semibold">Salaire</th>
                <th class="bg-neutral/20 text-[clamp(0.875rem,1.5vw,1rem)] font-dmserif font-semibold">Observation</th>
                <th class="bg-neutral/20 text-[clamp(0.875rem,1.5vw,1rem)] font-dmserif font-semibold">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(employee, index) in paginatedEmployees"
                :key="employee.numEmp"
                class="hover:bg-neutral/20 transition-all duration-300"
                data-aos="fade-up"
                :data-aos-delay="300 + index * 100"
              >
                <td class="font-dmserif text-base-content/90">{{ employee.numEmp }}</td>
                <td class="font-dmserif text-base-content/90">{{ employee.nom }}</td>
                <td class="font-dmserif text-accent">{{ employee.salaire.toLocaleString() }} Ar</td>
                <td>
                  <span :class="getObservationClass(employee.salaire)" class="font-dmserif px-3 py-1 rounded-full text-sm">
                    {{ getObservation(employee.salaire) }}
                  </span>
                </td>
                <td class="space-x-2">
                  <button
                    @click="openModal(employee)"
                    class="btn btn-primary btn-sm"
                    aria-label="Modifier l'employé"
                  >
                    Modifier
                  </button>
                  <button
                    @click="handleDelete(employee.numEmp)"
                    class="btn btn-sm btn-error text-white"
                    aria-label="Supprimer l'employé"
                  >
                    Supprimer
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-if="filteredEmployees.length === 0" class="text-center text-base-content/90 mt-6">
          Aucun employé trouvé.
        </div>

        <!-- Pagination -->
        <div v-if="filteredEmployees.length > itemsPerPage" class="flex justify-center mt-6 gap-2">
          <!-- Previous Button -->
          <button
            @click="currentPage = currentPage > 1 ? currentPage - 1 : 1"
            :disabled="currentPage === 1"
            class="btn btn-sm btn-ghost"
            aria-label="Page précédente"
          >
            <
          </button>
          
          <!-- First Page -->
          <button
            @click="currentPage = 1"
            :class="['btn btn-sm', currentPage === 1 ? 'btn-primary' : 'btn-ghost']"
            aria-label="Page 1"
          >
            1
          </button>

          <!-- Ellipsis if needed -->
          <span v-if="totalPages > 3 && currentPage > 2" class="flex items-center px-2">...</span>

          <!-- Current Page (only if not first or last) -->
          <button
            v-if="currentPage > 1 && currentPage < totalPages"
            @click="currentPage = currentPage"
            class="btn btn-sm btn-primary"
            :aria-label="`Page ${currentPage}`"
          >
            {{ currentPage }}
          </button>

          <!-- Ellipsis if needed -->
          <span v-if="totalPages > 3 && currentPage < totalPages - 1" class="flex items-center px-2">...</span>

          <!-- Last Page (if more than one page) -->
          <button
            v-if="totalPages > 1"
            @click="currentPage = totalPages"
            :class="['btn btn-sm', currentPage === totalPages ? 'btn-primary' : 'btn-ghost']"
            :aria-label="`Page ${totalPages}`"
          >
            {{ totalPages }}
          </button>

          <!-- Next Button -->
          <button
            @click="currentPage = currentPage < totalPages ? currentPage + 1 : totalPages"
            :disabled="currentPage === totalPages"
            class="btn btn-sm btn-ghost"
            aria-label="Page suivante"
          >
            >
          </button>
        </div>
      </div>

      <!-- Edit Modal -->
      <div v-if="isModalOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" data-aos="fade-in" data-aos-duration="300" aria-modal="true" role="dialog" aria-label="Modifier l'employé">
        <div class="relative bg-base-100 p-8 rounded-lg shadow-lg max-w-2xl w-full mx-4">
          <!-- Gradient Overlay -->
          <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-base-100/80 to-accent/10 z-0"></div>

          <!-- Animated Background Shapes -->
          <div class="absolute inset-0 z-0">
            <div class="absolute top-10 right-10 w-20 h-20 bg-secondary rounded-full opacity-40" data-aos="fade-down" data-aos-delay="100"></div>
            <div class="absolute top-20 right-20 w-24 h-24 bg-accent rounded-full opacity-40" data-aos="fade-down" data-aos-delay="300"></div>
            <div class="absolute top-30 right-30 w-16 h-16 bg-primary rounded-full opacity-40" data-aos="fade-down" data-aos-delay="500"></div>
          </div>

          <!-- Modal Content -->
          <div class="relative z-10">
            <h3 class="font-bold font-dmserif text-primary text-[clamp(1.5rem,4vw,2rem)] text-center mb-6" data-aos="fade-up">
              Modifier l'employé
            </h3>
            <div class="py-4 space-y-4" data-aos="fade-up" data-aos-delay="100">
              <div>
                <label class="block text-base-content/90 font-dmserif text-[clamp(1rem,1.5vw,1.125rem)] mb-2">
                  Nom :
                </label>
                <input
                  v-model="selectedEmployee.nom"
                  class="input input-bordered w-full bg-neutral/20 text-base-content"
                  aria-label="Nom de l'employé"
                />
              </div>
              <div>
                <label class="block text-base-content/90 font-dmserif text-[clamp(1rem,1.5vw,1.125rem)] mb-2">
                  Salaire (Ar) :
                </label>
                <input
                  v-model.number="selectedEmployee.salaire"
                  type="number"
                  class="input input-bordered w-full bg-neutral/20 text-base-content"
                  aria-label="Salaire de l'employé"
                />
              </div>
            </div>
            <div class="flex justify-center gap-4 mt-6" data-aos="fade-up" data-aos-delay="200">
              <button
                @click="isModalOpen = false"
                class="btn btn-outline text-base-content text-[clamp(0.875rem,1.5vw,1rem)] px-8 py-3 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 border-primary hover:bg-primary/10"
                aria-label="Fermer le modal"
              >
                Fermer
              </button>
              <button
                @click="saveChanges"
                class="btn btn-primary text-base-content text-[clamp(0.875rem,1.5vw,1rem)] px-8 py-3 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 bg-gradient-to-r from-primary to-accent"
                aria-label="Enregistrer les modifications"
              >
                Enregistrer
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AOS from 'aos'
import 'aos/dist/aos.css'
import api from '@/services/api'

export default {
  name: 'EmployeeTable',
  props: {
    employees: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  data() {
    return {
      searchQuery: '',
      currentPage: 1,
      itemsPerPage: 7,
      localEmployees: [...this.employees],
      pollingInterval: null,
      isModalOpen: false,
      selectedEmployee: {}
    }
  },
  computed: {
    filteredEmployees() {
      if (!this.searchQuery) return this.localEmployees
      return this.localEmployees.filter(employee =>
        employee.nom.toLowerCase().includes(this.searchQuery.toLowerCase())
      )
    },
    paginatedEmployees() {
      const start = (this.currentPage - 1) * this.itemsPerPage
      const end = start + this.itemsPerPage
      return this.filteredEmployees.slice(start, end)
    },
    totalPages() {
      return Math.ceil(this.filteredEmployees.length / this.itemsPerPage)
    }
  },
  methods: {
    getObservation(salaire) {
      if (salaire < 1000) return 'Médiocre'
      if (salaire <= 5000) return 'Moyen'
      return 'Grand'
    },
    getObservationClass(salaire) {
      if (salaire < 1000) return 'bg-secondary/20 text-secondary'
      if (salaire <= 5000) return 'bg-primary/20 text-primary'
      return 'bg-accent/20 text-accent'
    },
    async handleDelete(id) {
      try {
        await api.delete(`/employes/${id}`)
        this.localEmployees = this.localEmployees.filter(employee => employee.numEmp !== id)
        if (this.currentPage > this.totalPages && this.totalPages > 0) {
          this.currentPage = this.totalPages
        }
        alert('Supprimé !')
        this.$emit('employee-deleted', id)
      } catch (e) {
        alert('Erreur lors de la suppression.')
        console.error(e)
      }
    },
    async fetchEmployees() {
      try {
        const response = await api.get('/employes')
        this.localEmployees = response.data
        if (this.currentPage > this.totalPages && this.totalPages > 0) {
          this.currentPage = this.totalPages
        }
      } catch (e) {
        console.error('Erreur lors de la récupération des employés:', e)
      }
    },
    openModal(employee) {
      // Crée une copie pour éviter de modifier la donnée originale immédiatement
      this.selectedEmployee = { ...employee }
      this.isModalOpen = true
      document.body.classList.add('overflow-hidden')
    },
    async saveChanges() {
      try {
        // Basic validation
        if (!this.selectedEmployee.nom || this.selectedEmployee.salaire <= 0) {
          alert('Veuillez entrer un nom valide et un salaire positif.')
          return
        }
        // Update via API
        const updatedEmployee = {
          numEmp: this.selectedEmployee.numEmp,
          nom: this.selectedEmployee.nom,
          salaire: this.selectedEmployee.salaire
        }
        await api.put(`/employes/${updatedEmployee.numEmp}`, updatedEmployee)
        // Update localEmployees
        this.localEmployees = this.localEmployees.map(emp =>
          emp.numEmp === updatedEmployee.numEmp ? updatedEmployee : emp
        )
        alert('Employé modifié avec succès !')
        this.$emit('employee-updated', updatedEmployee)
        this.isModalOpen = false
        this.selectedEmployee = {}
        document.body.classList.remove('overflow-hidden')
      } catch (error) {
        alert('Erreur lors de la modification.')
        console.error(error)
      }
    }
  },
  mounted() {
    AOS.init({
      duration: 800,
      easing: 'ease-out',
      once: true
    })
    this.pollingInterval = setInterval(() => {
      this.fetchEmployees()
    }, 60000) // Adjusted to 60s to reduce polling frequency
    this.fetchEmployees()
  },
  beforeUnmount() {
    if (this.pollingInterval) {
      clearInterval(this.pollingInterval)
    }
    document.body.classList.remove('overflow-hidden')
  },
  watch: {
    searchQuery() {
      this.currentPage = 1
    },
    employees(newEmployees) {
      this.localEmployees = [...newEmployees]
    }
  }
}
</script>

<style scoped>
.table th, .table td {
  padding: 1rem;
  text-align: left;
}
.input {
  transition: all 0.3s ease;
}
.input:focus {
  @apply ring-2 ring-primary;
}
.btn {
  transition: all 0.3s ease;
}
.btn-error:hover {
  @apply bg-error/80;
}
.btn-primary:hover {
  @apply bg-gradient-to-r from-primary/80 to-accent/80;
}
.btn:disabled {
  @apply opacity-50 cursor-not-allowed;
}
</style>
