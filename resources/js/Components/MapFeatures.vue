
<template>
  <Listbox as="div" class="w-[170px] absolute lg:left-80 xs:left-12 xs:top-12.8" v-model="selected">
    <div class="relative mt-2">
      <ListboxButton class="cursor-pointer relative w-full rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
        <span class="flex items-center">
          <span class="ml-6 block truncate font-bold">{{ selected.name }}</span>
        </span>
        <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
          <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
        </span>
      </ListboxButton>

      <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
        <ListboxOptions class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
          <ListboxOption as="template" v-for="city in cities" :key="city.id" :value="city" v-slot="{ active, selected }">
            <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-3 pr-9']">
              <div class="flex items-center">
                <span @click="handleCityClick(city)" :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">{{ city.name }}</span>
              </div>

              <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                <CheckIcon class="h-5 w-5" aria-hidden="true" />
              </span>
            </li>
          </ListboxOption>
        </ListboxOptions>
      </transition>
    </div>
  </Listbox>
</template>

<script setup>
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import axios from 'axios';

const cities = [
  {
    id: 1,
    name: 'Ifran',
  },
  {
    id: 2,
    name: 'Marrakech',
  },
  {
    id: 3,
    name: 'Fez',
  },
  {
    id: 4,
    name: 'Rabat'
  },
  {
    id: 5,
    name: 'Agadir'
  },
]
const selected = ref(cities[1])
const searchQuery = ref(null)
const searchData = ref(null)
const queryTimeout = ref(null)

const search = async() => {
  const getData = await axios.get(`http://127.0.0.1:8000/api/search/${selected.value.name}`);

  searchData.value = getData.data.features[0];
  console.log('data of location : ',searchData.value);
}

const handleCityClick = (city) => {
  selected.value = city
  console.log(selected.value.name);
  search();
}

</script>