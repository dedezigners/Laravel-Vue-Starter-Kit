import { AuthUser } from "@/core/type";
import { router } from "@inertiajs/vue3";
import axios from "axios";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useAuthStore = defineStore('auth', () => {
    const loading = ref(true);
    const authenticated = ref(false);
    const authUser = ref<AuthUser | null>(null);

    const setAuth = (auth: any) => {
        authenticated.value = true;
        authUser.value = auth;
        router.visit(auth.is_admin ? '/admin' : '/dashboard');
    }

    const getAuth = () => {
        axios.post('/authenticated').then(res => {
            loading.value = false;
            authenticated.value = res.data?.data ? true : false;
            authUser.value = res.data?.data;
            console.log(user.value);
            removeSplashClass();
        }).catch(e => {
            loading.value = false;
            console.log(e.response.data);
            removeSplashClass();
        });
    }

    const removeSplashClass = () => {
        const body = document.querySelector('body');
        body?.classList.remove('de-splash')
    }

    const isLoading = computed(() => loading.value);
    const isAuthenticated = computed(() => authenticated.value);
    const user = computed(() => authUser.value);

    return {
        user,
        isLoading,
        isAuthenticated,
        setAuth,
        getAuth,
    }
});