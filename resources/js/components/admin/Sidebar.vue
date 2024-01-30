<template>
    <div :class="['de-sidebar', show ? 'active' : '']">
        <div class="de-sidebar__header">
            <Link class="de-brand" href="/admin">
                <!-- <img class="de-brand__logo de-brand__logo--mobile" src="/assets/images/logo/dede.svg" alt="DeDe"> -->
                <img class="de-brand__logo de-brand__logo--desktop" src="/assets/images/logo/logo-light.png" alt="DeDezigners">
            </Link>
        </div>
        <div class="de-sidebar__content">
            <ul class="de-sidebar__menu" v-for="(item, i) in SidebarMenu" :key="i">
                <li v-if="item.heading" class="de-sidebar__menu--heading">{{ item.heading }}</li>
                <li v-for="(menu, j) in item.pages" :key="j" class="de-sidebar__menu--item">
                    <MenuItem :menu="menu" :prefix="item.prefix" :active="urlPath === item.prefix + menu.route" />
                </li>
            </ul>
        </div>
        <div class="de-sidebar__footer">
            <a href="/" class="btn btn-highlight" target="_blank">Starter Kit</a>
        </div>
    </div>
</template>

<script lang="ts">
import SidebarMenu from '@/core/SidebarMenu';
import MenuItem from './MenuItem.vue';
import { router } from '@inertiajs/vue3';

export default {
    name: "DeSidebar",
    components: { MenuItem },
    props: {
        show: {
            type: Boolean,
            required: true,
        }
    },
    setup: () => {
        // @ts-ignore
        const urlPath = router.page.url;

        return {
            SidebarMenu,
            urlPath,
        }
    }
}
</script>