<template>
    <admin-layout :title="title" :breadcrumbs="breadcrumbs">
        <ProfileHead :user="user.data" type="change-password" />

        <div class="de-card">
            <div class="de-card__header de-card__header--b-btm">
                <h3 class="de-card--title">Change Password</h3>
            </div>
            <div class="de-card__body">
                <el-form class="de-form el-form--label-left" label-width="250px" @submit.prevent="onSubmit">
                    <el-form-item label="Current Password" :error="errors['current_password'] ? errors['current_password'][0] : null">
                        <el-input type="password" v-model="formData.current_password" />
                    </el-form-item>
                    <el-form-item label="New Password" :error="errors['password'] ? errors['password'][0] : null">
                        <el-input type="password" v-model="formData.password" />
                    </el-form-item>
                    <el-form-item label="Confirm New Password" :error="errors['password_confirmation'] ? errors['password_confirmation'][0] : null">
                        <el-input type="password" v-model="formData.password_confirmation" />
                    </el-form-item>

                    <button type="submit" :disabled="loading"
                    :class="['btn btn-lg btn-primary de-form__submit', loading ? 'de-form__submit--loading' : '']">
                        <span>Change Password</span>
                        <font-awesome-icon :icon="loading ? 'spinner' : 'arrow-right-long'" />
                    </button>
                </el-form>
            </div>
        </div>
    </admin-layout>
</template>

<script lang="ts">
import { Resource, User } from '@/core/type';
import { PropType, ref } from 'vue';
import ProfileHead from '@/components/admin/ProfileHead.vue';
import axios from 'axios';
import { clearForm } from '@/core/helper';
import { ElNotification } from 'element-plus';

export default {
    name: 'ChangePassword',
    components: { ProfileHead },
    props: {
        title: String,
        breadcrumbs: Array as PropType<String[]>,
        user: {
            type: Object as PropType<Resource<User>>,
            required: true,
        },
    },
    setup: (props) => {
        const loading = ref(false);
        const formData = ref<any>({
            current_password: null,
            password: null,
            password_confirmation: null,
        });
        const errors = ref<any>([]);

        const onSubmit = () => {
            loading.value = true;
            errors.value = [];
            
            axios.put(`/profile/change-password`, formData.value).then(res => {
                loading.value = false;
                ElNotification({
                    type: 'success',
                    title: 'Hooray!',
                    message: 'You password has successfully changed, please used your new password for login next time!',
                });
                formData.value = clearForm(formData.value);
            }).catch(error => {
                console.error(error.message);
                console.error(error.response.data);
                errors.value = error.response.data.errors ?? [];
                loading.value = false;
            });
        }
        
        return {
            loading,
            errors,
            formData,
            onSubmit,
        }
    }
}
</script>