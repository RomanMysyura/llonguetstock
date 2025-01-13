<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    categories: Array
});
</script>

<template>

    <Head title="Welcome" />
    <div class="h-auto w-full bg-white pb-10">

        <div class="title-div flex justify-center gap-2 pt-5">
            <p class="text-amber-900 font-bold text-4xl">Informació del magatzem</p>
            <img src="/img/logollonguet.avif" alt="Logo Llonguet" class="h-10 w-auto" />
        </div>
        <div class="mt-5">
            <p class="text-black text-3xl text-center">Selecciona una categoria</p>
        </div>
        <div class="categories grid grid-cols-2 gap-8 justify-items-center mt-10 ">
            <template v-for="category in categories" :key="category.id">
                <Link :href="`/category/${category.id}`" class="flex flex-col items-center justify-center border border-black rounded p-4 w-48 h-48 bg-gray-100 hover:bg-gray-200 transition">
                    <img :src="category.imageurl" :alt="category.name" class="h-24 w-auto" />
                    <p class="mt-2 text-black font-medium text-xl">{{ category.name }}</p>
                </Link>
            </template>
        </div>


    </div>
</template>
<style scoped>

@media (min-width: 800px) {
  .categories {
    margin-left: 100px;
    margin-right: 100px;
  }
}
@media (min-width: 1000px) {
  .categories {
    margin-left: 200px;
    margin-right: 200px;
  }
}
@media (min-width: 1150px) {
  .categories {
    margin-left: 300px;
    margin-right: 300px;
  }
}
@media (min-width: 1300px) {
  .categories {
    margin-left: 350px;
    margin-right: 350px;
  }
}
</style>

