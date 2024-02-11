<template>
    <header class="header">
        <div class="container">
            <div class="header-inner">
                <Link class="header-brand" href="/">
                <img class="header-brand--logo" src="/assets/images/logo/dede.svg" alt="DeDe">
                </Link>
                <nav class="header-nav">
                    <ul class="header-nav--list">
                        <li v-if="!authStore.isAuthenticated" class="header-nav--list-item">
                            <Link class="header-nav--link" href="/login">Login</Link>
                        </li>
                        <li v-if="!authStore.isAuthenticated" class="header-nav--list-item">
                            <Link class="header-nav--link" href="/register">Register</Link>
                        </li>
                        <li v-if="authStore.isAuthenticated" class="header-nav--list-item">
                            <Link class="header-nav--link" href="/logout">Logout</Link>
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
