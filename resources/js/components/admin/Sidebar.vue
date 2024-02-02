<template>
    <div :class="[
        'de-sidebar',
        small ? 'de-sidebar--sm' : '',
        show ? 'active' : '',
    ]">
        <div class="de-sidebar__toggle" @click="$emit('on-toogle')">
            <font-awesome-icon icon="arrow-left" />
        </div>
        <div class="de-sidebar__header">
            <Link class="de-brand" href="/admin">
                <img class="de-brand__logo de-brand__logo--sm" src="/assets/images/logo/logo-icon.png" alt="DeDe">
                <img class="de-brand__logo de-brand__logo--lg" src="/assets/images/logo/logo-light.png" alt="DeDezigners">
            </Link>
        </div>
        <div class="de-sidebar__content">
            <ul class="de-sidebar__menu" v-for="(item, i) in sidebarMenu" :key="i">
                <li v-if="item.heading" class="de-sidebar__menu--heading">{{ item.heading }}</li>
                <li v-for="(menu, j) in item.pages" :key="j" class="de-sidebar__menu--item">
                    <MenuItem :menu="menu" :prefix="item.prefix" :active="urlPath === item.prefix + menu.route" />
                </li>
            </ul>
        </div>
        <div class="de-sidebar__footer">
            <a href="/" class="btn btn-icon btn-highlight btn--sm" target="_blank">
                <font-awesome-icon icon="paper-plane" />
            </a>
            <a href="/" class="btn btn-block btn-highlight btn--lg" target="_blank">
                <font-awesome-icon class="me-2" icon="paper-plane" />
                <span>Starter Kit</span>
            </a>
        </div>
    </div>
</template>

<script lang="ts">
import sidebarMenu from '@/core/sidebarMenu';
import MenuItem from './MenuItem.vue';
import { router } from '@inertiajs/vue3';

export default {
    name: "DeSidebar",
    components: { MenuItem },
    props: {
        show: {
            type: Boolean,
            required: true,
        },
        small: {
            type: Boolean,
            default: false,
        }
    },
    emits: ['on-toogle'],
    setup: () => {
        // @ts-ignore
        const urlPath = router.page.url;

        return {
            sidebarMenu,
            urlPath,
        }
    }
}
</script>
