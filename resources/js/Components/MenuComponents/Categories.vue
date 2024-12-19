<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const categories = ref([]);
const isLoading = ref(true);
const searchTerm = ref('');

const filteredCategories = computed(() => {
    return categories.value.filter(category =>
        category.name.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
});

onMounted(() => {
    axios.get('/api/getallcatories')
        .then(response => {
            categories.value = response.data;
        })
        .catch(error => {
            console.error('Error al obtener las categorías:', error);
        })
        .finally(() => {
            isLoading.value = false;
        });
});
</script>

<template>
    <div class="h-full w-full bg-white">
        <div class="text-black font-bold text-center text-3xl mb-4">
            <p>Categories</p>
        </div>




        <div class="flex justify-center mb-4 ">
            <input v-model="searchTerm" type="text" placeholder="Buscar per nom..."
                class="rounded input-bordered border-black w-full max-w-xs bg-white" />
        </div>
        <div class="flex justify-center items-center h-64" v-if="isLoading">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <div v-else class="overflow-x-auto">
            <table class="table w-full text-black">
                <thead>
                    <tr>
                        <th class="text-black">Id</th>
                        <th class="text-black">Nom</th>
                        <th class="text-black">Acció</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in filteredCategories" :key="category.id">
                        <td>{{ category.id }}</td>
                        <td class="font-bold">{{ category.name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
