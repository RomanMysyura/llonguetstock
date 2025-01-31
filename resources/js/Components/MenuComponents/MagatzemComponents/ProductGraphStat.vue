<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import ApexCharts from 'vue3-apexcharts'

import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.css'

const allMovements = ref([])
const products = ref([])
const selectedProduct = ref('')

onMounted(async () => {
    const { data } = await axios.get('/api/getallmovements')
    allMovements.value = data
    products.value = [...new Set(data.map(item => item.name))]
})

function getProductData() {
    const filtered = allMovements.value.filter(m => m.name === selectedProduct.value)
    const grouped = {}
    filtered.forEach(m => {
        if (!grouped[m.date] || new Date(grouped[m.date].datetime) < new Date(m.datetime)) {
            grouped[m.date] = m
        }
    })
    return Object.values(grouped)
        .sort((a, b) => new Date(a.date) - new Date(b.date))
        .map(m => ({ x: m.date, y: m.aftervalue }))
}

const chartOptions = {
    chart: { type: 'area', height: 350 },
    xaxis: { type: 'datetime' },
    dataLabels: { enabled: false }
}
</script>

<template>
    <div class="mt-5">
        <Multiselect v-model="selectedProduct" :options="products" placeholder="Buscar producto..." :searchable="true"
            :allow-empty="true" :close-on-select="true" />
        <apex-charts height="350" :type="chartOptions.chart.type" :options="chartOptions" :series="[{
            name: selectedProduct || 'Stock',
            data: getProductData()
        }]" />
    </div>
</template>
