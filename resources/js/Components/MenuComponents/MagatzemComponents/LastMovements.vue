<script setup>
import { ref, onMounted, computed, defineProps } from 'vue'
import axios from 'axios'

const props = defineProps({
    goMoviments: Function
})

const movements = ref([])

onMounted(() => {
    axios.get('/api/getallmovements')
        .then(res => {
            movements.value = res.data
        })
        .catch(err => console.error(err))
})

function formatTime(datetime) {
    const dateObj = new Date(datetime)
    // Solo hora y minuto
    return dateObj.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
}

const latestEntries = computed(() => {
    return movements.value
        .filter(m => m.aftervalue > m.beforevalue)
        .sort((a, b) => new Date(b.datetime) - new Date(a.datetime))
        .slice(0, 10)
})

const latestExits = computed(() => {
    return movements.value
        .filter(m => m.aftervalue < m.beforevalue)
        .sort((a, b) => new Date(b.datetime) - new Date(a.datetime))
        .slice(0, 10)
})
</script>

<template>
    <div class="flex justify-center gap-4 mt-4">
        <div class="container mx-auto bg-white shadow-xl rounded-xl p-2 border-2 border-amber-900 flex flex-col">
            <p class="text-black font-bold text-center text-xl">Ultimes entrades</p>
            <table class="w-full text-black">
                <tbody>
                    <tr class="" v-for="entry in latestEntries" :key="entry.id">
                        <td class="flex">
                        <td class="h-6 w-6 flex items-center justify-center">
                            <div class="tooltip" :data-tip="entry.datetime">
                                <img src="/img/info.svg" alt="info" class="h-auto" />
                            </div>
                        </td>
                        {{ entry.name }}
                        </td>
                        <td class="text-right">
                            <div class="flex items-center justify-end">
                                <span>+{{ entry.aftervalue - entry.beforevalue }}</span>
                                <img src="/img/up.svg" alt="Eliminar" class="h-6 w-auto" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="text-gray-500 text-center cursor-pointer mt-auto" @click="props.goMoviments">
                Veure mes...
            </p>
        </div>


        <div class="container mx-auto bg-white shadow-xl rounded-xl p-2 border-2 border-amber-900 flex flex-col">
            <p class="text-black font-bold text-center text-xl">Ultimes sortides</p>
            <table class="w-full text-black">
                <tbody>
                    <tr v-for="exit in latestExits" :key="exit.id">
                        <td class="flex">
                        <td class="h-6 w-6 flex items-center justify-center">
                            <div class="tooltip" :data-tip="exit.datetime">
                                <img src="/img/info.svg" alt="info" class="h-auto" />
                            </div>
                        </td>{{ exit.name }}</td>
                        <td class="text-right">
                            <div class="flex items-center justify-end">
                                <span>-{{ exit.beforevalue - exit.aftervalue }}</span>
                                <img src="/img/down.svg" alt="Eliminar" class="h-6 w-auto" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="text-gray-500 text-center cursor-pointer mt-auto" @click="props.goMoviments">
                Veure mes...
            </p>
        </div>


        <div class="container mx-auto bg-white shadow-xl rounded-xl p-2 border-2 border-amber-900">
            <p class="text-black font-bold text-center text-xl">Alertas</p>
        </div>
    </div>
</template>
