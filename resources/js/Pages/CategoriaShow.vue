<script setup>
import { defineProps, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
    category: Object
});

const selectedProduct = ref(null);
const enteredQuantity = ref("0");

const showModal = (product) => {
    selectedProduct.value = product;
    enteredQuantity.value = "0"; // Reiniciamos al abrir el modal
    const dialog = document.getElementById("my_modal_3");
    if (dialog) {
        dialog.showModal();
    }
};

const addDigit = (digit) => {
    if (enteredQuantity.value === "0") {
        enteredQuantity.value = digit;
    } else {
        enteredQuantity.value += digit;
    }
};

const deleteLastDigit = () => {
    if (enteredQuantity.value.length > 1) {
        // Elimina el último carácter
        enteredQuantity.value = enteredQuantity.value.slice(0, -1);
    } else {
        // Si solo tiene un dígito, vuelve a "0"
        enteredQuantity.value = "0";
    }
};
</script>

<template>
    <div class="h-screen w-full bg-white p-10">
        <Link href="/" class="flex bg-amber-900 w-32 justify-center rounded ">
            <img src="/img/return.svg" alt="ok" class="h-6 w-auto" />
            <p class="text-white">Tornar</p>
        </Link>

        <h1 class="text-black text-4xl font-bold mb-8 text-center">
            {{ category.name }}
        </h1>

        <div class="space-y-4 p-5 rounded">
            <div v-for="product in category.products" :key="product.id" class="flex items-center justify-between">
                <span class="text-lg text-black">{{ product.name }}</span>

                <div class="flex items-center gap-3">
                    <div
                        class="bg-gray-300 rounded-full h-8 w-8 flex items-center justify-center text-black text-sm font-medium">
                        {{ product.quantity }}
                    </div>

                    <div class="bg-gray-300 rounded-full h-8 w-8 flex items-center justify-center cursor-pointer hover:bg-gray-400 transition"
                        @click="showModal(product)">
                        <span class="text-black text-xl font-bold">+</span>
                    </div>

                    <div
                        class="bg-gray-300 rounded-full h-8 w-8 flex items-center justify-center cursor-pointer hover:bg-gray-400 transition">
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
                    <p class="text-center text-3xl">En stock: {{ selectedProduct.quantity }} + </p>
                    <p class="text-3xl border p-px rounded shadow-inner bg-white w-20 text-center ml-1">{{
                        enteredQuantity }}</p>
                </div>

                <div v-if="selectedProduct" class="mt-4">
                    <div class="grid grid-cols-3 gap-2 w-48 mx-auto">
                        <button @click.prevent="addDigit('1')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">1</button>
                        <button @click.prevent="addDigit('2')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">2</button>
                        <button @click.prevent="addDigit('3')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">3</button>
                        <button @click.prevent="addDigit('4')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">4</button>
                        <button @click.prevent="addDigit('5')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">5</button>
                        <button @click.prevent="addDigit('6')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">6</button>
                        <button @click.prevent="addDigit('7')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">7</button>
                        <button @click.prevent="addDigit('8')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">8</button>
                        <button @click.prevent="addDigit('9')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">9</button>
                        <button @click.prevent="addDigit('0')"
                            class="bg-gray-300 rounded p-2 text-black font-bold hover:bg-gray-400 transition">0</button>
                        <button @click.prevent="deleteLastDigit"
                            class="bg-red-500 rounded p-2 text-white font-bold hover:bg-red-400 transition "><img
                                src="/img/delete.svg" alt="ok" class="h-6 w-auto ml-auto mr-auto" /></button>
                        <button class="bg-green-500 rounded p-2 text-white font-bold hover:bg-green-400 transition"><img
                                src="/img/confirm.svg" alt="ok" class="h-6 w-auto ml-auto mr-auto" /></button>
                    </div>
                </div>
            </div>
        </dialog>
    </div>
</template>
