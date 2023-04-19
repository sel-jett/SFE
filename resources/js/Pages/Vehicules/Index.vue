<script setup>
import CustomMap from '@/Components/CustomMap.vue';
import MapFeatures from '@/Components/MapFeatures.vue';
</script>

<template>

<div class="pt-[3.8rem] sm:ml-64 inline-flex">
        <MapFeatures class="z-20 w-auto absolute lg:right-[85rem] md:right-[85rem] xl:right-[85rem] sm:right-0 top-[5rem]"/>
        <CustomMap />
</div>
</template>
