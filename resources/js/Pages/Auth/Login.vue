<script setup>
import { useForm } from '@inertiajs/vue3';
import LoginAnimation from './Animations/LoginAnimation.vue';

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
   <div class="relative flex items-center justify-center h-screen bg-gray-100">
    <LoginAnimation class="animation" />
    <form @submit.prevent="submit" class="p-6 bg-white rounded shadow-md w-80 z-10 relative">
            <h2 class="text-2xl font-bold mb-4 text-center text-black">Iniciar sessió</h2>

            <input v-model="form.email" type="email" placeholder="Correu electrònic" required
                class="w-full p-2 mb-3 border border-gray-300 rounded text-black focus:outline-none focus:ring-1 focus:ring-amber-900 focus:border-amber-900" />

            <input v-model="form.password" type="password" placeholder="Contrasenya" required
                class="w-full p-2 mb-3 border border-gray-300 rounded text-black focus:outline-none focus:ring-1 focus:ring-amber-900 focus:border-amber-900" />

            <button type="submit" :disabled="form.processing"
                class="w-full bg-amber-900 text-white py-2 rounded hover:bg-amber-800 disabled:opacity-50">
                Iniciar sessió
            </button>
        </form>
    </div>
   
</template>
<style scoped>
.animation {
  position: absolute;
  inset: 0;
  z-index: 0;
}
</style>