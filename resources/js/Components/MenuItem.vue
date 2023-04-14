<script setup>
import { ref,toRefs, watchEffect } from 'vue'
import { usePage } from '@inertiajs/vue3';
const page = usePage()

const props = defineProps({
    iconString: String,
    iconSize: Number,
    pageUrl: String,
    name: String
})
const { iconString, pageUrl, name, iconSize } = toRefs(props)




let icon = ref(null)
let textIsHover = ref(false)

watchEffect(() => {
        if (page && page.url == pageUrl.value) {
            icon.value = iconString.value + '-active'
            textIsHover.value = true
        } else {
            icon.value = iconString.value + '-inactive'
            textIsHover.value = false
        }
    }
)
const isHover = () => {
        if(icon.value === iconString.value + '-active') return 
        if(icon.value === iconString.value + '-inactive'){
            icon.value = iconString.value +'-inactive-hover'
            textIsHover.value = true
        }else {
        
            icon.value = iconString.value +'-inactive'
            textIsHover.value = false
        
        }
    }
</script>

<template>
    <li
        class="flex items-center justify-start pb-4 cursor-pointer"
        @mouseenter="isHover()"
        @mouseleave="isHover()"
    >
        <img :width="iconSize" :src="`/images/icons/${icon}.png`">

        <div
            :class="textIsHover ? 'text-white' : 'text-gray-400'"
            class="font-semibold text-[14px] ml-4 mt-0.5"
        >
    <span :class=" page && page.url == pageUrl ? 'text-white' : ''" >
        {{ name }}
    </span>
        </div>
    </li>
</template>
