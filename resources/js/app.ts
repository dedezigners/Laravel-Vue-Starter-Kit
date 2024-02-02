import './bootstrap';

import { createApp, h, DefineComponent } from 'vue';
import { Link, createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import ElementPlus from 'element-plus';
import { createPinia } from "pinia";
import { Tooltip } from "bootstrap";

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faArrowLeft, faBars, faCaretDown, faCaretUp, faCartShopping, faDolly, faHouse, faLayerGroup, faMinus, faNewspaper, faPaperPlane, faSearch, faTags } from '@fortawesome/free-solid-svg-icons';

library.add(faBars, faSearch, faCaretDown, faCaretUp, faHouse, faMinus, faDolly, faLayerGroup, faCartShopping, faTags, faNewspaper, faArrowLeft, faPaperPlane);

// Layouts
import GuestLayout from '@/layouts/GuestLayout.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title ? title + ' -' : ''}${appName}`,
    resolve: (name) => resolvePageComponent(`./${name}.vue`, import.meta.glob<DefineComponent>('./**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app
        .component('GuestLayout', GuestLayout)
        .component('AppLayout', AppLayout)
        .component('AdminLayout', AdminLayout)
        .component('font-awesome-icon', FontAwesomeIcon)
        .component('Link', Link);
        
        app.use(plugin)
        .use(createPinia())
        .use(ZiggyVue)
        .use(ElementPlus);

        app.directive("tooltip", (el) => {
            new Tooltip(el);
        });
        
        app.mount(el);
    }
});
