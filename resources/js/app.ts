import './bootstrap';

import { createApp, h, DefineComponent } from 'vue';
import { Link, createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import ElementPlus from 'element-plus';

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
        .component('Link', Link);
        
        app.use(plugin)
        .use(ZiggyVue)
        .use(ElementPlus);
        
        app.mount(el);
    }
});
