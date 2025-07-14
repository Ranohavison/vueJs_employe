<template>
  <div class="relative bg-base-100 py-16 px-8 lg:px-32" id="form">
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
        Ajouter un Employé
      </h1>

      <div class="bg-neutral/50 backdrop-blur-sm p-8 rounded-lg shadow-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
        <Form v-slot="{ errors, meta }" @submit="handleSubmit" class="space-y-6" :validation-schema="schema" v-model="form">
          <!-- numEmp Field -->
          <div class="relative">
            <label for="numEmp" class="block text-base-content/90 font-dmserif text-[clamp(1rem,1.5vw,1.125rem)] mb-2">
              Numéro d'Employé
            </label>
            <Field
              name="numEmp"
              type="text"
              class="input input-bordered w-full bg-neutral/20 text-base-content"
              :class="{ 'border-2 border-red-500': errors.numEmp, 'border-2 border-green-500': !errors.numEmp && meta.touched.numEmp }"
              placeholder="Entrez le numéro d'employé"
              v-model="form.numEmp"
              @input="validateNumEmp"
            />
            <span class="text-red-500 text-sm mt-1 block" v-if="errors.numEmp">{{ errors.numEmp }}</span>
            <span class="text-green-500 text-sm mt-1 block" v-else-if="!errors.numEmp && meta.touched.numEmp">Numéro valide</span>
          </div>

          <!-- nom Field -->
          <div class="relative">
            <label for="nom" class="block text-base-content/90 font-dmserif text-[clamp(1rem,1.5vw,1.125rem)] mb-2">
              Nom
            </label>
            <Field
              name="nom"
              type="text"
              class="input input-bordered w-full bg-neutral/20 text-base-content"
              :class="{ 'border-2 border-red-500': errors.nom, 'border-2 border-green-500': !errors.nom && meta.touched.nom }"
              placeholder="Entrez le nom"
              v-model="form.nom"
            />
            <span class="text-red-500 text-sm mt-1 block" v-if="errors.nom">{{ errors.nom }}</span>
            <span class="text-green-500 text-sm mt-1 block" v-else-if="!errors.nom && meta.touched.nom">Nom valide</span>
          </div>

          <!-- salaire Field -->
          <div class="relative">
            <label for="salaire" class="block text-base-content/90 font-dmserif text-[clamp(1rem,1.5vw,1.125rem)] mb-2">
              Salaire (Ar)
            </label>
            <Field
              name="salaire"
              type="number"
              class="input input-bordered w-full bg-neutral/20 text-base-content"
              :class="{ 'border-2 border-red-500': errors.salaire, 'border-2 border-green-500': !errors.salaire && meta.touched.salaire }"
              placeholder="Entrez le salaire"
              v-model.number="form.salaire"
            />
            <span class="text-red-500 text-sm mt-1 block" v-if="errors.salaire">{{ errors.salaire }}</span>
            <span class="text-green-500 text-sm mt-1 block" v-else-if="!errors.salaire && meta.touched.salaire">Salaire valide</span>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-center">
            <button
              type="submit"
              class="btn btn-primary text-base-content text-[clamp(0.875rem,1.5vw,1rem)] px-10 py-4 rounded-full shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 bg-gradient-to-r from-primary to-accent"
              :disabled="!meta.valid"
            >
              Ajouter
            </button>
          </div>
        </Form>
      </div>
    </div>
  </div>
</template>

<script>
import AOS from 'aos'
import 'aos/dist/aos.css'
import { Form, Field } from 'vee-validate'
import * as Yup from 'yup'
import api from '@/services/api'

export default {
  name: 'EmployeeForm',
  components: {
    Form,
    Field
  },
  data() {
    return {
      form: {
        numEmp: '',
        nom: '',
        salaire: null
      },
      schema: Yup.object({
        numEmp: Yup.string()
          .required('Le numéro d\'employé est requis')
          .max(50, 'Le numéro d\'employé ne doit pas dépasser 50 caractères')
          .test('unique-numEmp', 'Ce numéro d\'employé existe déjà', async (value) => {
            if (!value) return true // Skip if empty (handled by required)
            try {
              const response = await api.get(`/employes/check-numEmp/${value}`)
              return !response.data.exists // True if numEmp does not exist
            } catch (e) {
              console.error(e)
              return false // Assume invalid on error to be safe
            }
          }),
        nom: Yup.string()
          .required('Le nom est requis')
          .max(100, 'Le nom ne doit pas dépasser 100 caractères'),
        salaire: Yup.number()
          .required('Le salaire est requis')
          .positive('Le salaire doit être positif')
          .max(1000000, 'Le salaire ne doit pas dépasser 1 000 000 Ar')
      })
    }
  },
  methods: {
    async handleSubmit(values, { resetForm }) {
      try {
        await api.post('/employes', values)
        alert('Employé ajouté avec succès !')
        // Emit event to parent to refresh employee list
        this.$emit('employee-added', values)
        // Reset form after successful submission
        resetForm()
      } catch (e) {
        alert('Erreur lors de l\'ajout de l\'employé.')
        console.error(e)
      }
    },
    async validateNumEmp() {
      // Trigger validation for numEmp field on input
      this.$refs.form.validateField('numEmp')
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
.input {
  transition: all 0.3s ease;
}
.input:focus {
  @apply ring-2 ring-primary;
}
.btn {
  transition: all 0.3s ease;
}
.btn-primary:hover {
  @apply bg-gradient-to-r from-primary/80 to-accent/80;
}
.btn:disabled {
  @apply opacity-50 cursor-not-allowed;
}
</style>