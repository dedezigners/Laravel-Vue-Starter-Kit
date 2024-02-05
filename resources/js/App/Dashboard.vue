<template>
    <app-layout>
        <h1>Welcome {{ user?.name }} !</h1>
    </app-layout>
</template>

<script lang="ts">
import { useAuthStore } from '@/store/auth';

export default {
    name: "Dashboard",
    setup: () => {
        const authUser = useAuthStore();
        const user = authUser.user;

        return {
            user,
        }
    }
}
</script>
