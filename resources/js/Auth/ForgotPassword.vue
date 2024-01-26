<template>
    <guest-layout>
        <el-form class="de-auth__form" label-position="top">
            <h3 class="de-auth__form--title">Forgot Password?</h3>
            <el-form-item label="Username or Email Address" :error="errors['identity'] ? errors['identity'][0] : null">
                <el-input v-model="formData.identity"
                placeholder="info@example.com" />
            </el-form-item>

            <div v-if="message" class="alert alert-info">{{ message }}</div>
            <div v-if="errors.message" class="alert alert-danger p-2">{{ errors.message }}</div>

            <el-button type="default" @click="onSubmit">Reset Password Link</el-button>
            <p class="de-auth__form--message"><Link href="/login">Back to Login?</Link></p>
        </el-form>
    </guest-layout>
</template>

<script lang="ts">
import axios from 'axios';
import { ref } from 'vue';

export default {
    name: "AppForgotPassword",
    setup: () => {
        const errors = ref<any>([]);
        const message = ref<string | null>(null)
        const formData = ref({
            identity: null,
        });

        const onSubmit = () => {
            errors.value = [];

            axios.post(`forgot-password`, formData.value).then(res => {
                message.value = res.data.message;
                formData.value.identity = null;
            }).catch(error => {
                console.error(error.response.data);
                errors.value = error.response.data.errors ?? [];
                errors.value.message = error.response.data.message;
            });
        }

        return {
            errors,
            message,
            formData,
            onSubmit,
        }
    }
}
</script>
