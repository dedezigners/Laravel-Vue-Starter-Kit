<template>
    <div :class="['de-admin']">
        <div v-if="showSidebar" :class="showSidebar ? 'de-admin--overlay' : ''" @click.self="showSidebar = false"></div>
        <DeHeader :class="smallSidebar ? 'de-header--lg' : ''" @show-sidebar="showSidebar = true" />

        <div class="de-admin__wrapper">
            <DeSidebar :show="showSidebar" :small="smallSidebar" @on-toogle="smallSidebar = !smallSidebar" />
            
            <div :class="['de-admin__main', smallSidebar ? 'de-admin__main--lg' : '']">
                <DeBreadcrumb :title="title" :breadcrumbs="breadcrumbs" />
                <div class="de-admin__content">
                    <slot></slot>
                </div>
                <DeFooter />
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { PropType, ref } from 'vue';
import DeHeader from '@/components/admin/Header.vue';
import DeSidebar from '@/components/admin/Sidebar.vue';
import DeBreadcrumb from '@/components/admin/Breadcrumb.vue';
import DeFooter from '@/components/admin/Footer.vue';
import { useAuthStore } from '@/store/auth';

export default {
    name: "Admin",
    components: {
        DeHeader,
        DeSidebar,
        DeBreadcrumb,
        DeFooter,
    },
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
    },
    setup: () => {
        const authStore = useAuthStore();
        const showSidebar = ref(false);
        // TODOS: smallSidebar should worked with state properties for no behaviour change on page load!
        const smallSidebar = ref(false);
        authStore.getAuth();
        
        return {
            showSidebar,
            smallSidebar,
        }
    }
}
</script>
