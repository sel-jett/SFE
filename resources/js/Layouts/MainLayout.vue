<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3'
import ChevronUp from 'vue-material-design-icons/ChevronUp.vue'
import ChevronDown from 'vue-material-design-icons/ChevronDown.vue'
import ChevronRight from 'vue-material-design-icons/ChevronRight.vue'
import ChevronLeft from 'vue-material-design-icons/ChevronLeft.vue'
import MenuItem from '@/Components/MenuItem.vue';

import { useGeneralStore } from '@/stores/general';
import { storeToRefs } from 'pinia';
const useGeneral = useGeneralStore();
const { isPostOverlay, isCropperModal, isImageDisplay} = storeToRefs(useGeneral)

/* const user = usePage().props.auth.user; */
let openMenue = ref(false)
</script>

<template>
   <div>
    <header>
        <div class="
        w-[calc(100%-240px)]
        h-[60px]
        fixed
        right-0
        z-20
        bg-[#101010]
        bg-opacity-80
        flex
        items-center
        justify-between
        "
        >
        <div class="flex items-center ml-6">
            <button class="rounded-full bg-black p-[1px] cursor-pointer">
                <ChevronLeft fillColor="#FFFFFF" :size="30" />
            </button>
            <button class="rounded-full bg-black p-[1px] ml-4 cursor-pointer">
                <ChevronRight fillColor="#FFFFFF" :size="30" />
            </button>
        </div>
        <button
        @click="openMenue = !openMenue" :class="openMenue ? 'bg-[#282828]' : 'bg-black'"
        class="bg-black hover:bg-[#282828] rounded-full p-0.5 mr-8 mt-0.5 cursor-pointer"><div class="flex items-center">
            <img class="rounded-full" width="27" src="https://yt3.ggpht.com/ytc/AGIKgqPVfTZSmWUYd-i0DXYh4aLRXltrSCwpVIslXObY_S70nUAAB46zyJlmMbE55zTV=s88-c-k-c0x00ffffff-no-rj-mo">
            <div class="text-white text-[14px] ml-1.5 font-semibold">POGO</div>
            <ChevronDown v-if="!openMenue" @click="openMenue = true" fillColor="#FFFFFF" :size="25" />
            <ChevronUp v-else @click="openMenu = false" fillColor="#FFFFFF" :size="25" /> 
        </div>
    </button>
    <span
    v-if="openMenue"
    class="fixed w-[190px] bg-[#282828] shadow-2xl z-50 rounded-sm top-[52px] right-[35px] p-1 cursor-pointer">
    <ul class="text-gray-200 font-semibold text-[14px]">
        <li class="px-3 py-2.5 hover:bg-[#3E3D3D] border-b-gray-600">Log out</li>
    </ul>
</span>
</div>
</header>
<div id="SideNav"  class="h-[100%] p-6 w-[240px] fixed z-50 bg-black">
    <Link>
        <img src="/images/icons/pogo-logo.png" width="125" >
    </Link>
    <div class="my-8"></div>
    <ul>
        <Link href="/">
            <MenuItem class="ml-[1px]" :iconSize="23" name="Home" iconString="home" pageUrl="/"/>
        </Link>
        <Link href="/search">
            <MenuItem class="ml-[1px]" :iconSize="24" name="Search" iconString="search" pageUrl="/search"/>
        </Link>
        <Link href="/clients">
            <MenuItem class="ml-[2px]" :iconSize="23" name="Clients" iconString="library" pageUrl="/search"/>
        </Link>
        <div class="py-3.5"></div>
        <MenuItem :iconSize="24" name="Create Vehicul" iconString="playlist" pageUrl="/playlist" />
    </ul>
    <div class="border-b border-b-gray-700"></div>
    <ul>
        <li class="font-demibold text-[13px] mt-3 text-gray-300 hover:text-white">#Marrackech</li>
        <li class="font-demibold text-[13px] mt-3 text-gray-300 hover:text-white">#Ifran</li>
        <li class="font-demibold text-[13px] mt-3 text-gray-300 hover:text-white">#Fes</li>
    </ul>
</div>
</div>

<div
    class="
        fixed
        right-0
        top-0
        w-[calc(100%-240px)]
        overflow-auto
        h-full
        bg-gradient-to-b
        from-[#1C1C1C]
        to-black
    "
>
<div class="mt-[70px]"></div>
<slot />
<div class="mb=[100px]"></div>
</div>
</template>
