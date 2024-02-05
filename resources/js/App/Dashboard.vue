<template>
    <app-layout>
        <h1>Welcome {{ authStore.user?.name }} !</h1>
    </app-layout>
</template>

<script lang="ts">
import { useAuthStore } from '@/store/auth';

export default {
    name: "Dashboard",
    setup: () => {
        const authStore = useAuthStore();

        return {
            authStore,
        }
    }
}
</script>
