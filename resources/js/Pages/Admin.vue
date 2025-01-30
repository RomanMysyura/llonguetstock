<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Categories from '@/Components/MenuComponents/Categories.vue';
import Magatzem from '@/Components/MenuComponents/Magatzem.vue';
import Productes from '@/Components/MenuComponents/Productes.vue';
import Moviments from '@/Components/MenuComponents/Moviments.vue';
const activeComponent = ref('magatzem');

const showMagatzem = () => { activeComponent.value = 'magatzem' };
const showCategories = () => { activeComponent.value = 'categories' };
const showProductes = () => { activeComponent.value = 'productes' };
const showMoviments = () => { activeComponent.value = 'moviments' };
</script>

<template>
    <Head title="Admin" />
    <div class="min-h-screen w-full bg-white flex">
        <div class="Menu flex flex-col bg-amber-900 w-64 min-h-screen">
            <button 
                class="w-64 h-10 transition-colors duration-200"
                :class="activeComponent === 'magatzem' ? 'bg-amber-700 text-white' : 'bg-amber-900 hover:bg-amber-700'"
                @click="showMagatzem"
            >
                <p class="text-left ml-2 text-white">Magatzem</p>
            </button>
            <button 
                class="w-64 h-10 transition-colors duration-200"
                :class="activeComponent === 'categories' ? 'bg-amber-700 text-white' : 'bg-amber-900 hover:bg-amber-700'"
                @click="showCategories"
            >
                <p class="text-left ml-2 text-white">Categories</p>
            </button>
            <button 
                class="w-64 h-10 transition-colors duration-200"
                :class="activeComponent === 'productes' ? 'bg-amber-700 text-white' : 'bg-amber-900 hover:bg-amber-700'"
                @click="showProductes"
            >
                <p class="text-left ml-2 text-white">Productes</p>
            </button>
            <button 
                class="w-64 h-10 transition-colors duration-200"
                :class="activeComponent === 'moviments' ? 'bg-amber-700 text-white' : 'bg-amber-900 hover:bg-amber-700'"
                @click="showMoviments"
            >
                <p class="text-left ml-2 text-white">Moviments</p>
            </button>
        </div>

        <div class="flex-1 p-4">
            <Magatzem
  v-if="activeComponent === 'magatzem'"
  :goMoviments="showMoviments"
/>

            <Categories v-if="activeComponent === 'categories'" />
            <Productes v-if="activeComponent === 'productes'" />
            <Moviments v-if="activeComponent === 'moviments'" />
        </div>
    </div>
</template>
