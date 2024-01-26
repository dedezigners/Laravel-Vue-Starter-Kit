<template>
    <guest-layout>
        <el-form class="de-auth__form" label-position="top">
            <h3 class="de-auth__form--title">Register</h3>
            <el-form-item label="Your Name" :error="errors['name'] ? errors['name'][0] : null">
                <el-input v-model="formData.name"
                placeholder="Alex Croft" />
            </el-form-item>
            <el-form-item label="Email Address" :error="errors['email'] ? errors['email'][0] : null">
                <el-input v-model="formData.email"
                placeholder="alex@example.com" />
            </el-form-item>
            <el-form-item label="Username" :error="errors['username'] ? errors['username'][0] : null">
                <el-input v-model="formData.username"
                placeholder="alex.croft" />
            </el-form-item>
            <el-form-item label="Password" :error="errors['password'] ? errors['password'][0] : null">
                <el-input v-model="formData.password"
                type="password"
                placeholder="Password" />
            </el-form-item>
            <el-form-item label="Confirm Password" :error="errors['password_confirmation'] ? errors['password_confirmation'][0] : null">
                <el-input v-model="formData.password_confirmation"
                type="password"
                placeholder="Password" />
            </el-form-item>
            <el-button type="default" @click="onSubmit">Register</el-button>
            <p class="de-auth__form--message">Already have an account? <Link href="/login">Login Here</Link></p>
        </el-form>
    </guest-layout>
</template>

<script lang="ts">
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';

export default {
    name: "AppRegister",
    setup: () => {
        const errors = ref<any>([]);
        const formData = ref({
            name: null,
            email: null,
            username: null,
            password: null,
            password_confirmation: null,
        });

        const onSubmit = () => {
            errors.value = [];

            axios.post(`register`, formData.value).then(res => {
                router.visit(res.data.data.is_admin ? '/admin' : '/dashboard');
            }).catch(error => {
                console.error(error.response.data);
                errors.value = error.response.data.errors ?? [];
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
