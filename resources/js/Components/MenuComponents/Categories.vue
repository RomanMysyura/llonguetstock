<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';

const categories = ref([]);
const isLoading = ref(true);

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

const editCategory = (id) => {
    console.log(`Edit category with ID: ${id}`);
};

const deleteCategory = (id) => {
    console.log(`Delete category with ID: ${id}`);
};
</script>

<template>
    <div class="h-full w-full bg-white">
        <div class="text-black font-bold text-center text-3xl mb-4">
            <p>Categories</p>
        </div>

        <div class="flex justify-center items-center h-64" v-if="isLoading">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4" v-else>
            <div v-for="category in categories" :key="category.id"
                class="relative border rounded p-4 shadow bg-gray-100 text-center group">
                <p class="text-lg font-semibold text-black">{{ category.name }}</p>

                <div
                    class="absolute rounded top-0 left-0 w-full h-full bg-gray-500 bg-opacity-50 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button @click="editCategory(category.id)"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Editar</button>
                    <button @click="deleteCategory(category.id)"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</template>
