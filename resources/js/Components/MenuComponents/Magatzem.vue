<script setup>
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue'
import GeneralStat from './MagatzemComponents/GeneralStat.vue';
import LastMovements from './MagatzemComponents/LastMovements.vue';

const props = defineProps({
  goMoviments: Function
})
</script>

<template>

    <div class="h-full w-full bg-white ">
        <div class="text-black font-bold text-center text-3xl">
            <p>Magatzem</p>
        </div>
        <GeneralStat />
        <LastMovements :goMoviments="props.goMoviments" />


    </div>
</template>
