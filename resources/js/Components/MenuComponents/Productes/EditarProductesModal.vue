<script setup>
import { defineProps, defineEmits, reactive, watch, ref, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
    product: {
        type: Object,
        default: () => ({ id: null, name: '', quantity: 0, category_id: 0 })
    }
})
const emit = defineEmits(['product-updated'])

const form = reactive({
    id: props.product.id,
    name: props.product.name,
    quantity: props.product.quantity,
    category_id: props.product.category_id
})

const showConfirmDelete = ref(false)

watch(
    () => props.product,
    (newVal) => {
        form.id = newVal.id
        form.name = newVal.name
        form.quantity = newVal.quantity
        form.category_id = newVal.category_id
        showConfirmDelete.value = false
    },
    { immediate: true, deep: true }
)

const categories = ref([])

onMounted(() => {
    axios.get('/api/getallcategories')
        .then(res => {
            categories.value = res.data
        })
        .catch(err => console.error(err))
})

function updateProduct() {
    axios.post('/api/updateproduct', form)
        .then(response => {
            console.log(response.data.message)
            document.getElementById('my_modal_editproduct').close()
            emit('product-updated')
        })
        .catch(error => {
            console.error('Error actualitzant el producte', error)
        })
}

function askDelete() {
    showConfirmDelete.value = true
}

function cancelDeletion() {
    showConfirmDelete.value = false
}

function confirmDeletion() {
    axios.post('/unsignproduct', { product_id: form.id })
        .then(response => {
            console.log(response.data.message)
            document.getElementById('my_modal_editproduct').close()
            emit('product-updated')
        })
        .catch(error => {
            console.error('Error eliminant el producte', error)
        })
}
</script>

<template>
    <dialog id="my_modal_editproduct" class="modal">
        <div class="modal-box bg-white">

            <div v-if="!showConfirmDelete">

                <div class="flex">
                    <h3 class="text-lg font-bold text-black">
                        Editar {{ form.name }}
                    </h3>
                    <p class="ml-auto">#{{ form.id }}</p>

                </div>

                <form @submit.prevent="updateProduct" class="space-y-4">
                    <div>
                        <label class="block text-black">Nom</label>
                        <input v-model="form.name" type="text"
                            class="w-full border border-gray-300 p-2 rounded text-black" />
                    </div>
                    <div>
                        <label class="block text-black">Quantitat</label>
                        <input v-model="form.quantity" type="number"
                            class="w-full border border-gray-300 p-2 rounded text-black" />
                    </div>
                    <div>
                        <label class="block text-black">Categoria</label>
                        <select v-model="form.category_id" class="w-full border border-gray-300 p-2 rounded text-black">
                            <option v-for="cat in categories" :value="cat.id" :key="cat.id">
                                {{ cat.name }}
                            </option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="askDelete" class="text-white rounded hover:scale-110 mr-auto">
                            <img src="/img/delete-svgrepo-com.svg" alt="Eliminar" class="h-6 w-auto" />
                        </button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Actualitzar
                        </button>
                        <button type="button" onclick="document.getElementById('my_modal_editproduct').close()"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Tancar
                        </button>
                    </div>
                </form>
            </div>

            <div v-else class="flex flex-col items-center justify-center h-72">
                <p class="text-center text-xl font-bold mb-6 text-black">
                    Estàs segur que vols eliminar el producte?
                </p>
                <div class="flex gap-4">
                    <button @click.prevent="confirmDeletion"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors duration-300">
                        Sí
                    </button>
                    <button @click.prevent="cancelDeletion"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors duration-300">
                        No
                    </button>
                </div>
            </div>

        </div>
    </dialog>
</template>
