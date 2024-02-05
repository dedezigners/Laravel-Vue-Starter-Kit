<template>
    <div class="de-auth">
        <slot></slot>
    </div>
</template>

<script lang="ts">
import { useAuthStore } from '@/store/auth';

export default {
    name: "Auth",
    setup: () => {
        const authStore = useAuthStore();
        authStore.getAuth();

        return {}
    }
}
</script>
