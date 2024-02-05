<template>
    <header class="de-header">
        <div class="container">
            <div class="de-header-inner">
                <Link class="de-header-brand" href="/">
                <img class="de-header-brand--logo" src="/assets/images/logo/dede.svg" alt="DeDe">
                </Link>
                <nav class="de-header-nav">
                    <ul class="de-header-nav--list">
                        <li v-if="!authStore.isAuthenticated" class="de-header-nav--list-item">
                            <Link class="de-header-nav--link" href="/login">Login</Link>
                        </li>
                        <li v-if="!authStore.isAuthenticated" class="de-header-nav--list-item">
                            <Link class="de-header-nav--link" href="/register">Register</Link>
                        </li>
                        <li v-if="authStore.isAuthenticated" class="de-header-nav--list-item">
                            <Link class="de-header-nav--link" href="/logout">Logout</Link>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</template>

<script lang="ts">
import { useAuthStore } from '@/store/auth';

export default {
    name: "AppHeader",
    setup: () => {
        const authStore = useAuthStore();

        return {
            authStore,
        }
    }
}
</script>
