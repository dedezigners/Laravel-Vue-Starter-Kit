<template>
    <guest-layout>
        <el-form class="de-auth__form" label-position="top">
            <h3 class="de-auth__form--title">Reset Password</h3>
            <el-form-item label="New Password" :error="errors['password'] ? errors['password'][0] : null">
                <el-input v-model="formData.password"
                type="password" placeholder="New Password" />
            </el-form-item>
            
            <el-form-item label="Confirm New Password" :error="errors['password'] ? errors['password'][0] : null">
                <el-input v-model="formData.password_confirmation"
                type="password" placeholder="Confirm new password" />
            </el-form-item>
    
            <div v-if="errors.message" class="alert alert-danger p-2">{{ errors.message }}</div>
    
            <el-button type="default" @click="onSubmit">Update Password</el-button>
        </el-form>
    </guest-layout>
</template>

<script lang="ts">
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

export default {
    name: "AppResetPassword",
    setup: () => {
        const errors = ref<any>([]);
        const formData = ref({
            password: null,
            password_confirmation: null,
        });

        const onSubmit = () => {
            errors.value = [];

            axios.post(`login`, formData.value).then(res => {
                router.visit(res.data.data.is_admin ? '/admin' : '/dashboard');
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
