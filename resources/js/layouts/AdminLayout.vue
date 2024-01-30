<template>
    <div class="de-admin">
        <div :class="showSidebar ? 'de-admin--overlay' : ''" @click.self="showSidebar = false"></div>
        <DeHeader @show-sidebar="showSidebar = true" />

        <div class="de-wrapper">
            <DeSidebar :show="showSidebar" />
            
            <div class="de-main">
                <DeBreadcrumb />
                <div class="de-content">
                    <div class="container-fluid">
                        <slot></slot>
                    </div>
                </div>
                <DeFooter />
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { ref } from 'vue';
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
    setup: () => {
        const showSidebar = ref(false);
        const onResizeScreen = () => {
            const screenWidth = window.innerWidth;
            showSidebar.value = screenWidth < 991;
        }
        onResizeScreen();
        

        return {
            showSidebar,
        }
    }
}
</script>
