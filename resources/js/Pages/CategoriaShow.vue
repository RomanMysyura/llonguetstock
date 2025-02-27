<script setup>
import { defineProps, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    category: Object
});

const selectedProduct = ref(null);
const enteredQuantity = ref("0");
const operation = ref("+");

const showModal = (product, op) => {
    selectedProduct.value = product;
    operation.value = op;
    enteredQuantity.value = "0";
    const dialog = document.getElementById("my_modal_3");
    if (dialog) {
        dialog.showModal();
    }
};

const addDigit = (digit) => {
    enteredQuantity.value = enteredQuantity.value === "0" ? digit : enteredQuantity.value + digit;
};

const deleteLastDigit = () => {
    enteredQuantity.value = enteredQuantity.value.length > 1
        ? enteredQuantity.value.slice(0, -1)
        : "0";
};

const confirmChange = () => {
    axios.post('/changeproductquanity', {
        product_id: selectedProduct.value.id,
        operation: operation.value,
        quantity: enteredQuantity.value
    }).then(response => {
        // Actualizar cantidad local (opcional)
        if (operation.value === '+') {
            selectedProduct.value.quantity = parseInt(selectedProduct.value.quantity) + parseInt(enteredQuantity.value);
        } else {
            selectedProduct.value.quantity = parseInt(selectedProduct.value.quantity) - parseInt(enteredQuantity.value);
        }
        document.getElementById("my_modal_3").close();
    });
};
</script>

<template>
    <div class="h-auto w-full bg-white p-10">
        <Link href="/" class="flex bg-amber-900 w-32 justify-center rounded">
            <img src="/img/return.svg" alt="ok" class="h-6 w-auto" />
            <p class="text-white">Tornar</p>
        </Link>

        <h1 class="text-black text-4xl font-bold mb-8 text-center">
            {{ category.name }}
        </h1>

        <div class="space-y-1  rounded products">
            <div v-for="product in category.products" :key="product.id" class="flex items-center justify-between p-2 rounded-xl">
                <span class="text-lg text-black font-bold">{{ product.name }}</span>
                <div class="flex items-center gap-3">
                    <div class="bg-gray-300 rounded-full h-8 w-8 flex items-center justify-center text-black text-sm font-bold">
                        {{ product.quantity }}
                    </div>

                    <div class="bg-gray-300 rounded-full h-8 w-8 flex items-center justify-center cursor-pointer hover:bg-gray-400 transition"
                        @click="showModal(product, '+')">
                        <span class="text-black text-xl font-bold">+</span>
                    </div>

                    <div class="bg-gray-300 rounded-full h-8 w-8 flex items-center justify-center cursor-pointer hover:bg-gray-400 transition"
                        @click="showModal(product, '-')">
                        <span class="text-black text-xl font-bold">−</span>
                    </div>
                </div>
            </div>
        </div>

        <dialog id="my_modal_3" class="modal">
            <div class="modal-box bg-gray-100 text-black">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-black">✕</button>
                </form>
                <h3 v-if="selectedProduct" class="text-lg font-bold mb-2">{{ selectedProduct.name }}</h3>

                <div v-if="selectedProduct" class="flex justify-center items-center">
                    <p class="text-center text-3xl">En stock: {{ selectedProduct.quantity }} {{ operation }} </p>
                    <p class="text-3xl border p-px rounded shadow-inner bg-white w-20 text-center ml-1">{{ enteredQuantity }}</p>
                </div>

                <div v-if="selectedProduct" class="mt-4">
                    <div class="grid grid-cols-3 gap-2 w-48 mx-auto">
                        <button @click.prevent="addDigit('1')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">1</button>
                        <button @click.prevent="addDigit('2')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">2</button>
                        <button @click.prevent="addDigit('3')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">3</button>
                        <button @click.prevent="addDigit('4')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">4</button>
                        <button @click.prevent="addDigit('5')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">5</button>
                        <button @click.prevent="addDigit('6')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">6</button>
                        <button @click.prevent="addDigit('7')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">7</button>
                        <button @click.prevent="addDigit('8')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">8</button>
                        <button @click.prevent="addDigit('9')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">9</button>
                        <button @click.prevent="addDigit('0')" class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">0</button>
                        <button @click.prevent="deleteLastDigit" class="bg-red-500 rounded p-2 text-white font-bold hover:bg-red-400 transition"><img src="/img/delete.svg" alt="ok" class="h-6 w-auto ml-auto mr-auto" /></button>
                        <button @click.prevent="confirmChange" class="bg-green-500 rounded p-2 text-white font-bold hover:bg-green-400 transition"><img src="/img/confirm.svg" alt="ok" class="h-6 w-auto ml-auto mr-auto" /></button>
                    </div>
                </div>
            </div>
        </dialog>
    </div>
</template>

<style scoped>
@media (min-width: 800px) {
    .products {
        margin-left: 100px;
        margin-right: 100px;
    }
}

@media (min-width: 1000px) {
    .products {
        margin-left: 200px;
        margin-right: 200px;
    }
}

@media (min-width: 1150px) {
    .products {
        margin-left: 300px;
        margin-right: 300px;
    }
}

@media (min-width: 1300px) {
    .products {
        margin-left: 350px;
        margin-right: 350px;
    }
}
</style>
