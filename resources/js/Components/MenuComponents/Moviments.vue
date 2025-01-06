<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Head } from '@inertiajs/vue3';

const movements = ref([]);
const groupedMovements = ref({});

const fetchMovements = async () => {
    try {
        const response = await axios.get('/api/getallmovements');
        movements.value = response.data;
        movements.value.sort((a, b) => new Date(b.date) - new Date(a.date));

        groupedMovements.value = {};
        movements.value.forEach(movement => {
            const dateKey = movement.date;
            if (!groupedMovements.value[dateKey]) {
                groupedMovements.value[dateKey] = {};
            }
            if (!groupedMovements.value[dateKey][movement.name]) {
                groupedMovements.value[dateKey][movement.name] = { beforevalue: movement.beforevalue, aftervalue: movement.aftervalue };
            } else {
                groupedMovements.value[dateKey][movement.name].aftervalue = movement.aftervalue;
            }
        });
    } catch (error) {
        console.error('Error fetching movements:', error);
    }
};

onMounted(fetchMovements);
</script>

<template>
    <div class="h-full w-full bg-white p-2">
        <div class="text-black font-bold text-center text-3xl mb-2">
            <p>Moviments de Productes</p>
        </div>
        <div v-for="(products, date) in groupedMovements" :key="date" class="mb-8 p-2">
            <div class="flex items-center justify-center gap-2 bg-amber-900 rounded">
                <h2 class="text-2xl font-bold text-center text-white">{{ date }}</h2>
                
            </div>

            <table class="table-auto w-full">
                <thead>
                    <tr class="text-amber-900">
                        <th class="px-4 py-2 text-left">Producte</th>
                        <th class="px-4 py-2">Cantidad Inicial</th>
                        <th class="px-4 py-2">Cantidad Final</th>
                        <th class="px-4 py-2">Cambi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(movement, name, index) in products" :key="name"
                        :class="index % 2 === 0 ? 'bg-gray-100' : 'bg-white'" class="text-center text-black">
                        <td class="px-4 py-2 text-left">{{ name }}</td>
                        <td class="px-4 py-2">{{ movement.beforevalue }}</td>
                        <td class="px-4 py-2">{{ movement.aftervalue }}</td>
                        <td class="px-4 py-2"
                            :class="movement.aftervalue > movement.beforevalue ? 'text-green-500' : 'text-red-500'">
                            {{ movement.aftervalue - movement.beforevalue }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
