<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

const categories = ref([])
const newProduct = ref({
    name: '',
    quantity: 0,
    category_id: 1
})

const allProducts = computed(() => {
    return categories.value.flatMap(cat => cat.products)
})

onMounted(() => {
    axios.get('/api/getallcategories')
        .then(res => {
            categories.value = res.data
        })
        .catch(err => console.error(err))
})

function createProduct() {
    axios.post('/api/createproduct', newProduct.value)
        .then(res => {
            document.getElementById('my_modal_2').close()
        })
        .catch(err => console.error(err))
    axios.get('/api/getallcategories')
        .then(res => {
            categories.value = res.data
        })
        .catch(err => console.error(err))
}
</script>

<template>
    <div class="h-full w-full bg-white">
        <div class="text-black font-bold text-center text-3xl mb-4">
            <p>Categories</p>
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

       
        <table class="table-auto w-full mt-4 ">
            <thead>
                <tr class="bg-amber-900 text-white">
                    <th class="px-4 py-2 text-left">Producte</th>
                    <th class="px-4 py-2 text-left">Quantitat</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody class="">
                <tr v-for="(product, index) in allProducts" :key="product.id"
                    :class="index % 2 === 0 ? 'bg-gray-100' : 'bg-white'" class="text-black">
                    <td class="px-4 py-2 text-left">{{ product.name }}</td>
                    <td class="px-4 py-2 text-left">{{ product.quantity }}</td>
                    <td class="px-4 py-2">
                        <button @click="openEditModal(product.id)"
                            class="ml-auto flex items-center bg-amber-700 text-white gap-1 px-4 py-2 font-semibold rounded hover:bg-amber-900 duration-300 h-6 w-auto">
                            Editar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>
