<script setup>
import { defineProps, defineEmits, ref, watch } from 'vue'
import axios from 'axios'
import DeleteProduct from './DeleteProduct.vue'

const props = defineProps({
  category: {
    type: Object,
    default: null,
  },
})

const emits = defineEmits(['update-category'])
const localCategory = ref(null)

watch(
  () => props.category,
  (newVal) => {
    localCategory.value = newVal
  },
  { immediate: true }
)

const confirmDelete = ref(false)

const unsignProduct = (product) => {
  axios
    .post('/unsignproduct', { product_id: product.id })
    .then(response => {
      if (localCategory.value && localCategory.value.products) {
        localCategory.value.products = localCategory.value.products.filter(
          p => p.id !== product.id
        )
      }
      emits('update-category', localCategory.value)
      console.log(response.data.message)
    })
    .catch(error => {
      console.error('Error al desassignar el producto:', error)
    })
}

const showConfirmMessage = () => {
  confirmDelete.value = true
}

const cancelDeletion = () => {
  confirmDelete.value = false
}


const confirmDeletion = () => {
  console.log('Categoría eliminada')
}
</script>

<template>
  <dialog id="my_modal_3" class="modal">
    <div class="modal-box bg-white text-black">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      </form>

   
      <div v-if="!confirmDelete">
        <h3 class="text-2xl font-bold text-center">{{ localCategory?.name }}</h3>
        <div v-if="localCategory?.products" class="mt-4 h-72 overflow-y-auto overflow-x-hidden shadow-inner rounded p-2">
          <ul class="space-y-2">
            <li v-for="product in localCategory.products" :key="product.id"
                class="flex justify-between items-center pb-2">
              <span>{{ product.name }}</span>
              <button class="text-white rounded hover:scale-110" @click.prevent="unsignProduct(product)">
                <img src="/img/delete-svgrepo-com.svg" alt="Eliminar" class="h-6 w-auto" />
              </button>
            </li>
          </ul>
        </div>
        
        <DeleteProduct @click="showConfirmMessage" />
      </div>
      
      <div v-else class="flex flex-col items-center justify-center h-72">
        <p class="text-center text-xl font-bold mb-6">
          ¿Seguro que quieres eliminar la categoría?
        </p>
        <div class="flex gap-4">
          <button @click.prevent="confirmDeletion"
                  class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition-colors duration-300">
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
