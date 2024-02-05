<template>
    <guest-layout>
        <el-form class="de-auth__form" label-position="top">
            <h3 class="de-auth__form--title">Login</h3>
            <el-form-item label="Email or Username" :error="errors['identity'] ? errors['identity'][0] : null">
                <el-input v-model="formData.identity"
                placeholder="info@example.com" />
            </el-form-item>
            <el-form-item label="Password" :error="errors['password'] ? errors['password'][0] : null">
                <el-input v-model="formData.password"
                type="password"
                placeholder="Password" />
            </el-form-item>
    
            <div class="de-auth__form--info">
                <el-checkbox label="Remember Me" v-model="formData.remember" />
                <Link href="/forgot-password">Forgot Password?</Link>
            </div>
    
            <div v-if="errors.message" class="alert alert-danger p-2">{{ errors.message }}</div>
    
            <el-button type="default" @click="onSubmit">Login</el-button>
            <p class="de-auth__form--message">Don't have an account? <Link href="/register">Register Here</Link></p>
        </el-form>
    </guest-layout>
</template>

<script lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import { useAuthStore } from '@/store/auth';

export default {
    name: "AppLogin",
    setup: () => {
        const authStore = useAuthStore();
        const errors = ref<any>([]);
        const formData = ref({
            identity: null,
            password: null,
            remember: false,
        });

        const onSubmit = () => {
            errors.value = [];

            axios.post(`login`, formData.value).then(res => {
                authStore.setAuth(res.data.data);
            }).catch(error => {
                console.error(error.response.data);
                errors.value = error.response.data.errors ?? [];
                errors.value.message = error.response.data.message;
            });
        }

        return {
            errors,
            formData,
            onSubmit,
        }
    }
}
</script>
