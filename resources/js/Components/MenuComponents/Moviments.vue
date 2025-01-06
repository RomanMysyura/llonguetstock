<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

const movements = ref([
    { name: 'Producto A', beforevalue: 100, aftervalue: 90, date: '2024-01-01' },
    { name: 'Producto B', beforevalue: 50, aftervalue: 70, date: '2024-01-01' },
    { name: 'Producto C', beforevalue: 200, aftervalue: 180, date: '2024-01-02' },
    { name: 'Producto C', beforevalue: 180, aftervalue: 130, date: '2024-01-02' },
    { name: 'Producto D', beforevalue: 300, aftervalue: 310, date: '2024-01-02' }
]);

const groupedMovements = ref({});

movements.value.forEach(movement => {
    if (!groupedMovements.value[movement.date]) {
        groupedMovements.value[movement.date] = {};
    }
    if (!groupedMovements.value[movement.date][movement.name]) {
        groupedMovements.value[movement.date][movement.name] = { beforevalue: movement.beforevalue, aftervalue: movement.aftervalue };
    } else {
        groupedMovements.value[movement.date][movement.name].aftervalue = movement.aftervalue;
    }
});
</script>

<template>
    <div class="h-full w-full bg-white p-2">
        <div class="text-black font-bold text-center text-3xl mb-8">
            <p>Moviments de Productes</p>
        </div>

        <div v-for="(products, date) in groupedMovements" :key="date" class="mb-8 p-2 ">
            <h2 class="text-xl font-bold mb-1 text-center text-black">{{ date }}</h2>
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead> 
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Producte</th>
                        <th class="border border-gray-300 px-4 py-2">Valor Antes</th>
                        <th class="border border-gray-300 px-4 py-2">Valor Después</th>
                        <th class="border border-gray-300 px-4 py-2">Cambi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(movement, name) in products" :key="name" class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ movement.beforevalue }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ movement.aftervalue }}</td>
                        <td class="border border-gray-300 px-4 py-2"
                            :class="movement.aftervalue > movement.beforevalue ? 'text-green-500' : 'text-red-500'">
                            {{ movement.aftervalue - movement.beforevalue }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
