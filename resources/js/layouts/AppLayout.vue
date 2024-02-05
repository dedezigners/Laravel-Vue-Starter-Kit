<template>
    <SplashScreen v-if="authStore.isLoading" />
    <div v-else class="de-app">
        <AppHeader />
        <div class="de-app__content">
            <slot></slot>
        </div>
        <AppFooter />
    </div>
</template>

<script lang="ts">
import SplashScreen from '@/components/Splashscreen.vue';
import AppHeader from '@/components/app/Header.vue';
import AppFooter from '@/components/app/Footer.vue';
import { useAuthStore } from '@/store/auth';

export default {
    name: "App",
    components: { SplashScreen, AppHeader, AppFooter },
    setup: () => {
        const authStore = useAuthStore();
        authStore.getAuth();

        return {
            authStore,
        }
    }
}
</script>
