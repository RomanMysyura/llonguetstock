<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import EditarCategoriaModal from './Categories/EditarCategoriaModal.vue';

const categories = ref([]);
const selectedCategory = ref(null);
const isLoading = ref(true);
const searchTerm = ref('');
const newCategory = ref({ name: '', imageurl: '', filename: '' });

const openEditModal = (category) => {
  selectedCategory.value = category;
  document.getElementById('my_modal_3').showModal();
};

const filteredCategories = computed(() => {
  return categories.value.filter(category =>
    category.name.toLowerCase().includes(searchTerm.value.toLowerCase())
  );
});

const createCategory = () => {
  const formData = new FormData();
  formData.append('name', newCategory.value.name);
  formData.append('image', newCategory.value.file);

  axios
    .post('/api/createcategory', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then(response => {
      document.getElementById('my_modal_2').close();
      categories.value.push(response.data.category);
    })
    .catch(error => {
      console.error('Error al crear la categoría:', error);
    });
};

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    newCategory.value.imageurl = URL.createObjectURL(file);
    newCategory.value.filename = file.name;
    newCategory.value.file = file;
  }
};

const updateCategory = (payload) => {
  if (payload === null) {
    getAllCategories(); // Recarga la lista si se recibe null
  } else {
    // Actualiza la categoría en el array si lo necesitas
  }
};


const getAllCategories = () => {
  axios.get('/api/getallcategories')
    .then(response => {
      categories.value = response.data;
    })
    .catch(error => console.error(error))
    .finally(() => {
      isLoading.value = false;
    });
};

onMounted(() => {
  getAllCategories();
});

</script>

<template>
  <div class="h-full w-full bg-white">
    <div class="text-black font-bold text-center text-3xl mb-4">
      <p>Categories</p>
    </div>

    <button onclick="my_modal_2.showModal()"
      class="flex items-center bg-amber-900 text-white gap-1 px-4 py-2 cursor-pointer font-semibold tracking-widest rounded-md hover:bg-amber-700 duration-300">
      Crear nova categoria
    </button>
    
    <dialog id="my_modal_2" class="modal">
      <div class="modal-box bg-white">
        <h3 class="text-lg font-bold text-black">Crear una nova categoria</h3>
        <form @submit.prevent="createCategory" class="space-y-4 mt-4">
          <div>
            <label class="block text-black">Nombre</label>
            <input v-model="newCategory.name" type="text"
              class="w-full border border-gray-300 p-2 rounded text-black">
          </div>
          <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
            <div class="md:flex">
              <div class="w-full">
                <div class="relative h-48 rounded-lg border-2 border-blue-500 bg-gray-50 flex justify-center items-center shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
                  <div class="absolute flex flex-col items-center">
                    <img alt="File Icon" class="mb-3" src="https://img.icons8.com/dusk/64/000000/file.png" />
                    <span class="block text-gray-500 font-semibold" v-if="!newCategory.filename">
                      Arrossega i deixa anar els teus fitxers aquí
                    </span>
                    <span class="block text-gray-500 font-semibold" v-else>
                      {{ newCategory.filename }}
                    </span>
                    <span class="block text-gray-400 font-normal mt-1" v-if="!newCategory.filename">
                      o fes clic per pujar-los
                    </span>
                  </div>
                  <input class="h-full w-full opacity-0 cursor-pointer" type="file" @change="handleFileChange" />
                </div>
              </div>
            </div>
          </div>
          <div class="flex justify-end gap-2">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Guardar</button>
            <button type="button" onclick="my_modal_2.close()"
              class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cerrar</button>
          </div>
        </form>
      </div>
    </dialog>
    
    <EditarCategoriaModal :category="selectedCategory" @update-category="updateCategory" />

    <table class="table-auto w-full mt-4">
      <thead>
        <tr class="bg-amber-900 text-white">
          <th class="px-4 py-2 text-left">Categories</th>
          <th class="px-4 py-2">Productes assignats</th>
          <th class="px-4 py-2"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(category, index) in categories" :key="category.id"
            :class="index % 2 === 0 ? 'bg-gray-100' : 'bg-white'" class="text-center text-black">
          <td class="px-4 py-2 text-left">{{ category.name }}</td>
          <td class="px-4 py-2">{{ category.products ? category.products.length : 0 }} </td>
          <td class="px-4 py-2">
            <button @click="openEditModal(category)"
              class="ml-auto flex items-center bg-amber-700 text-white gap-1 px-4 py-2 font-semibold rounded hover:bg-amber-900 duration-300 h-6 w-auto">
              Editar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
