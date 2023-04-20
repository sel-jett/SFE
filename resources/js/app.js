import './bootstrap';
import '../css/app.css';
import 'flowbite';
import 'tw-elements';

import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy';
import MainLayout from '@/Layouts/MainLayout.vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { createPinia } from 'pinia';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import MapFeatures from '@/Components/MapFeatures.vue';

let app = null; // Change from const to let to allow reassignment

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);

createInertiaApp({
  resolve: async (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue');

    const page = await pages[`./Pages/${name}.vue`]();
    page.default.layout = page.default.layout || MainLayout;

    return page;
  },
  setup({ el, App, props, plugin }) {
    app = createApp({ render: () => h(App, props) });
    app.use(plugin)
      .use(pinia)
      .use(ZiggyVue)
      .component('MapFeatures', MapFeatures) // Declare MapFeatures as a global component
      .mount(el);
  },
});
