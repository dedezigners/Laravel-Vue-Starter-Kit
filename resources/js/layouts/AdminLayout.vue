<template>
    <div class="de-admin">
        <div :class="showSidebar ? 'de-admin--overlay' : ''" @click.self="showSidebar = false"></div>
        <DeHeader @show-sidebar="showSidebar = true" />

        <div class="de-admin__wrapper">
            <DeSidebar :show="showSidebar" />
            
            <div class="de-admin__main">
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
        const showSidebar = ref(false);
        
        return {
            showSidebar,
        }
    }
}
</script>
