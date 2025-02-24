<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import EditarProductesModal from './Productes/EditarProductesModal.vue'

const categories = ref([])
const newProduct = ref({
  name: '',
  quantity: 0,
  category_id: 1
})
const searchTerm = ref('')
const selectedProduct = ref({
  id: null,
  name: '',
  quantity: 0,
  category_id: null
})

// Incluimos el nombre y la imagen de la categoría en cada producto
const allProducts = computed(() => {
  return categories.value.flatMap(cat =>
    cat.products.map(product => ({
      ...product,
      categoryName: cat.name,
      categoryImage: cat.imageurl
    }))
  )
})

const filteredProducts = computed(() => {
  return allProducts.value.filter(product =>
    product.name.toLowerCase().includes(searchTerm.value.toLowerCase())
  )
})

function refreshProducts() {
  axios.get('/api/getallcategories')
    .then(res => {
      categories.value = res.data
    })
    .catch(err => console.error(err))
}

onMounted(() => {
  refreshProducts()
})

function createProduct() {
  axios.post('/api/createproduct', newProduct.value)
    .then(() => {
      document.getElementById('my_modal_2').close()
      refreshProducts()
    })
    .catch(err => console.error(err))
}

function openEditModal(product) {
  selectedProduct.value = { ...product }
  document.getElementById('my_modal_editproduct').showModal()
}
</script>

<template>
  <div class="h-full w-full bg-white">
    <div class="text-black font-bold text-center text-3xl mb-4">
      <p>Productes</p>
    </div>
    <button onclick="my_modal_2.showModal()"
            class="flex items-center bg-amber-900 text-white gap-1 px-4 py-2 font-semibold rounded-md hover:bg-amber-700 duration-300">
      Crear nou producte
    </button>

    <dialog id="my_modal_2" class="modal">
      <div class="modal-box bg-white">
        <h3 class="text-lg font-bold text-black">Crear un nou producte</h3>
        <form @submit.prevent="createProduct" class="space-y-4 mt-4">
          <div>
            <label class="block text-black">Nom</label>
            <input v-model="newProduct.name" type="text"
                   class="w-full border border-gray-300 p-2 rounded text-black" />
          </div>
          <div>
            <label class="block text-black">Categoria</label>
            <select v-model="newProduct.category_id"
                    class="w-full border border-gray-300 p-2 rounded text-black">
              <option v-for="cat in categories" :value="cat.id" :key="cat.id">
                {{ cat.name }}
              </option>
            </select>
          </div>
          <div class="flex justify-end gap-2">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
              Guardar
            </button>
            <button type="button" onclick="my_modal_2.close()"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
              Cerrar
            </button>
          </div>
        </form>
      </div>
    </dialog>

    <!-- Camp de cerca -->
    <div class="mt-4">
      <input v-model="searchTerm" type="text" placeholder="Cerca producte..."
             class="w-full border border-gray-300 p-2 rounded text-black" />
    </div>

    <!-- Llista de productes -->
    <table class="table-auto w-full mt-4">
      <thead>
        <tr class="bg-amber-900 text-white">
          <th class="px-4 py-2 text-left">Categoria / Producte</th>
          <th class="px-4 py-2 text-center">Quantitat</th>
          <th class="px-4 py-2"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product, index) in filteredProducts" :key="product.id"
            :class="index % 2 === 0 ? 'bg-gray-100' : 'bg-white'" class="text-black">
          <td class="px-2 py-1 text-left">
            <img :src="product.categoryImage" alt="Categoria" class="w-10 h-auto inline-block mr-2" />
            {{ product.name }}
          </td>
          <td class="px-4 py-2 text-center">{{ product.quantity }}</td>
          <td class="px-4 py-2">
            <button @click="openEditModal(product)"
                    class="ml-auto flex items-center bg-amber-700 text-white gap-1 px-4 py-2 font-semibold rounded hover:bg-amber-900 duration-300 h-6 w-auto">
              Editar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    
    <!-- Modal per editar producte -->
    <EditarProductesModal :product="selectedProduct" @product-updated="refreshProducts" />
  </div>
</template>
