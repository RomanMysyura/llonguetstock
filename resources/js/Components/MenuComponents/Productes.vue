<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const categories = ref([])
const newProduct = ref({
    name: '',
    quantity: 0,
    category_id: 1
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
    </div>
</template>
