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
import { faArrowDownLong, faArrowLeft, faArrowRightLong, faArrowRotateLeft, faBars, faCaretDown, faCaretUp, faCartShopping, faCircleExclamation, faClose, faDolly, faHouse, faImage, faLayerGroup, faMinus, faNewspaper, faPaperPlane, faPenToSquare, faSearch, faSpinner, faTags, faTrash, faTrashCan, faUserGear, faUserGroup, faUserLock } from '@fortawesome/free-solid-svg-icons';

library.add(faBars, faSearch, faCaretDown, faCaretUp, faHouse, faMinus, faDolly, faLayerGroup, faCartShopping, faTags, faNewspaper, faArrowLeft, faPaperPlane, faClose, faArrowRightLong, faArrowDownLong, faPenToSquare, faSpinner, faTrash, faArrowRotateLeft, faTrashCan, faUserGroup, faUserGear, faUserLock, faImage, faCircleExclamation);

// Layouts
import GuestLayout from '@/layouts/GuestLayout.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import AdminLayout from '@/layouts/AdminLayout.vue';
import DeTable from './components/datatable/DeDatatable.vue';

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
        .component('DeDatatable', DeTable)
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
