<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const totalCategories = ref(0)
const totalProducts = ref(0)

onMounted(async () => {
  const { data } = await axios.get('/api/getallcategories')
  totalCategories.value = data.length
  totalProducts.value = data.reduce(
    (sum, category) => sum + category.products.length,
    0
  )
})
</script>

<template>
    
        <div class="stats stats-vertical lg:stats-horizontal shadow bg-amber-900 text-white w-full mt-3">
            <div class="stat">
                <div class="stat-title text-white font-bold">Total Categories</div>
                <div class="stat-value">{{ totalCategories }}</div>
            </div>

            <div class="stat">
                <div class="stat-title text-white font-bold">Total Productes</div>
                <div class="stat-value">{{ totalProducts }}</div>
            </div>

            <div class="stat">
                <div class="stat-title text-white font-bold">Alertas</div>
                <div class="stat-value">---</div>
            </div>
        </div>



   
</template>
