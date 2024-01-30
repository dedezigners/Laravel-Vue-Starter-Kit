<template>
    <div v-if="menu.children?.length"
    :class="['item has-children', showSubmenu ? 'has-children--active' : '']"
    @click="showSubmenu = !showSubmenu">
        <font-awesome-icon class="item--icon" :icon="menu.icon ?? `minus`" />
        <span class="item--text">{{ menu.name }}</span>
        <font-awesome-icon v-if="menu.children?.length" class="item--arrow" icon="caret-down" />
    </div>
    <Link v-else :class="['item', active ? 'active' : '']" :href="prefix + menu.route">
        <font-awesome-icon class="item--icon" :icon="menu.icon ?? `minus`" />
        <span class="item--text">{{ menu.name }}</span>
    </Link>
    <ul :class="['sub-menu', showSubmenu ? 'show' : '']">
        <li class="sub-menu--item" v-for="(item, i) in menu.children" :key="i">
            <MenuItem :menu="item" :prefix="prefix" />
        </li>
    </ul>
</template>

<script lang="ts">
import { MenuItem } from '@/core/type';
import { PropType, ref } from 'vue';

export default {
    name: "MenuItem",
    props: {
        menu: {
            type: Object as PropType<MenuItem>,
            required: true,
        },
        prefix: String,
        active: Boolean
    },
    setup() {
        const showSubmenu = ref(false);
        
        return {
            showSubmenu,
        }
    }
}
</script>
