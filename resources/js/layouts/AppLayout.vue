<template>
    <div class="de-app">
        <AppHeader />
        <div class="de-app__content">
            <slot></slot>
        </div>
        <AppFooter />
    </div>
</template>

<script lang="ts">
import AppHeader from '@/components/app/Header.vue';
import AppFooter from '@/components/app/Footer.vue';
import { useAuthStore } from '@/store/auth';

export default {
    name: "App",
    components: { AppHeader, AppFooter },
    setup: () => {
        const authStore = useAuthStore();
        authStore.getAuth();

        return {}
    }
}
</script>
