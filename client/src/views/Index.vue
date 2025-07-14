<template>
  <Navbar />
  <Hero />
  <Forms />
  <Table :employees="employees"/>
  <Bilan :employees="employees"/>
  <Foot />
</template>

<script setup lang="ts">
import Navbar from '../components/Navbar.vue'
import Hero from '../components/Hero.vue'
import Foot from '../components/Footer.vue'
import Bilan from '@/components/Bilan.vue'
import Table from '@/components/Table.vue'
import Forms from '@/components/Form.vue'

import { ref, onMounted } from 'vue';
import api from '@/services/api';

interface Employe {
  numEmp: string;
  nom: string;
  salaire: number;
}

const employees = ref<Employe[]>([]);
const error = ref<string | null>(null);

onMounted(async () => {
  try {
    const response = await api.get<Employe[]>('/employes');
    console.log('Réponse API:', response.data);
    employees.value = response.data;
    console.log(employees);
  } catch (e) {
    error.value = 'Erreur lors du chargement des utilisateurs';
    console.error(e);
  }
});
</script>

<style scoped>
</style>